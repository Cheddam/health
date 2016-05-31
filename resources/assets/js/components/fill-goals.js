var $ = require('jquery');
var React = require('react');
var ReactDOM = require('react-dom');
var Redux = require('redux');
require('../helpers/assign');

var Total = React.createClass({
	render: function() {
		return (
			<div className={this.props.points > 0 ? 'total-points' : 'total-points no-points'}>
				<h2 className="points">{this.props.points}</h2>
				<p>goal{this.props.points == 1 ? '' : 's'} completed today</p>
			</div>
		);
	}
});

var Goal = React.createClass({
	handleClick: function() {
		store.dispatch({
			type: 'TOGGLE_GOAL_COMPLETED',
			id: this.props.id
		});
	},
	classes: function() {
		var classes = ['goal'];

		if (this.props.completed) classes.push('goal-completed');
		if (this.props.classnames) classes.push(this.props.classnames);

		return classes.join(' ');
	},
	render: function() {
		return (
			<div className={this.classes()} onClick={this.handleClick}>
				<span className="goal-points">{this.props.completed ? '✓' : '✗'}</span>
				{this.props.name}
			</div>
		);
	}
});

var Category = React.createClass({
	render: function() {
		return (
			<div className="category">
				<h3>{this.props.name}</h3>
				{this.props.goals.map(function(goal) {
					return (
						<Goal key={goal.id} id={goal.id} name={goal.name} points={goal.points} classnames={goal.classnames} completed={goal.completed} />
					);
				}, this)}
			</div>
		);
	}
});

var CategoryList = React.createClass({
	render: function() {
		return (
			<div className="category-list">
				{this.props.categories.map(function(category) {
					return (
						<Category key={category.name} name={category.name} goals={getGoalsForCategory(this.props.goals, category.id)} />
					);
				}, this)}
			</div>
		);
	}
});

var GoalInterface = React.createClass({
	render: function() {
		return (
			<div className="pure-u-1 goal-interface">
				<Total points={getTotalPoints(this.props.goals)} />
				<CategoryList categories={this.props.categories} goals={this.props.goals} />
			</div>
		);
	}
});

// Model

var goal = function(state, action) {

	switch (action.type) {
		case 'TOGGLE_GOAL_COMPLETED':
			if (state.id !== action.id) {
				return state;
			}

			if (! action.local) {
				$.ajax({
					url: '/goals/toggle/' + state.id,
					dataType: 'json',
					cache: false,
					error: function(xhr, status, err) {
						store.dispatch({
							type: 'TOGGLE_GOAL_COMPLETED',
							id: state.id,
							local: true
						});
						console.error('goal retrieval: ', status, err.toString());
					}
				});
			}

			return Object.assign({}, state, { completed: !state.completed });
		default:
			return state;
	}

}

var goals = function(state, action) {

	if (typeof state === 'undefined') {
		return [];
	} 

	switch (action.type) {
		case 'TOGGLE_GOAL_COMPLETED':
			return state.map(function(g) {
				return goal(g, action);
			});
		case 'ADD_GOALS':
			return state.concat(action.goals);
		default:
			return state;
	}

}

var categories = function(state, action) {

	if (typeof state === 'undefined') {
		return [];
	} 

	switch (action.type) {
		case 'ADD_CATEGORIES':
			return state.concat(action.categories);
		default:
			return state;
	}

}

var goalApp = function(state, action) {

	if (typeof state === 'undefined') {
		return {categories: [], goals: []};
	}

	return {
		goals: goals(
			state.goals,
			action
		),
		categories: categories(
			state.categories,
			action
		)
	}

}

var getGoalsForCategory = function(goals, category) {
	return goals.filter(function(goal, i, goals) {
		if (goal.category_id == this) {
			return goal;
		}
	}, category);
}

var getTotalPoints = function(goals) {
	var points = 0;

	goals.map(function(goal) {
		if (goal.completed) {
			points += parseInt(goal.points);
		}
	});

	return points;
}

// Initialization

var app = Redux.combineReducers({ goalApp });

var store = Redux.createStore(app);

$.ajax({
	url: '/goals/list',
	dataType: 'json',
	cache: false,
	success: function(data) {
		store.dispatch({
			type: 'ADD_GOALS',
			goals: data
		});
	}.bind(this),
	error: function(xhr, status, err) {
		console.error('goal retrieval: ', status, err.toString());
	}.bind(this)
});

$.ajax({
	url: '/categories/list',
	dataType: 'json',
	cache: false,
	success: function(data) {
		store.dispatch({
			type: 'ADD_CATEGORIES',
			categories: data
		});
	}.bind(this),
	error: function(xhr, status, err) {
		console.error('goal retrieval: ', status, err.toString());
	}.bind(this)
});

var render = function() {

	ReactDOM.render(
		<GoalInterface categories={store.getState().goalApp.categories} goals={store.getState().goalApp.goals} />,
		document.getElementById('goals')
	);

}

store.subscribe(render);
render();