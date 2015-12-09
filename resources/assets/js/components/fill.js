var Goal = React.createClass({
	handleClick: function() {
		store.dispatch({
			type: 'TOGGLE_COMPLETED',
			id: this.props.id
		}).bind(this);
	},
	render: function() {
		return (
			<div className={this.props.completed ? 'goal goal-completed' : 'goal'} onClick={this.handleClick}>
				<span className="goal-points">{this.props.points}</span>
				{this.props.name}
			</div>
		);
	}
});

var Category = React.createClass({
	render: function() {
		return (
			<div className="category">
				<h4>{this.props.name}</h4>
				{this.props.goals.map(function(goal) {
					return (
						<Goal key={goal.id} id={goal.id} name={goal.name} points={goal.points} completed={goal.completed} />
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
				{this.props.data.map(function(category) {
					return (
						<Category key={category.name} name={category.name} goals={category.goals} />
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
				<CategoryList goals={this.props.goals} />
			</div>
		);
	}
});

// MODEL FROM HERE ON OUT BITCHES

const goals = function(state = [], action) {

	switch (action.type) {
		case 'TOGGLE_COMPLETED':
			return state;
		case 'ADD_GOALS':
			return state.concat(action.goals);
	}

}

const todoApp = Redux.combineReducers({ goals });

const store = Redux.createStore(todoApp);

// Load ze goalzzzz
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

const render = function() {

	ReactDOM.render(
		<GoalInterface goals={store.getState().goals} />,
		document.getElementById('goals')
	);

}

store.subscribe(render);
render();

/*

Actions

TOGGLE_COMPLETED

*/


// $.ajax({
// 	url: '/goals/complete/' + id,
// 	dataType: 'json',
// 	type: 'POST',
// 	data: {
// 		'_token': $('meta[name=csrf-token]').attr('content')
// 	},
// 	success: function(data) {
// 		var localCats = this.state.data;

// 		for (var c = 0; c < localCats.count; c++) {
// 			for (var g = 0; g < localCats[c].goals.count; g++) {
// 				if (localCats[c].goals[g].id === data.goal_id) {
// 					localCats[c].goals[g].completed = true;
// 				}
// 			}
// 		}

// 		this.setState({data: localCats});
// 	}.bind(this),
// 	error: function(xhr, status, err) {
// 		console.error(this.props.url, status, err.toString());
// 	}.bind(this)
// });

	// loadGoalsFromServer: function() {

	// },
	// componentDidMount: function() {
	// 	this.loadGoalsFromServer();
	// 	setInterval(this.loadGoalsFromServer, this.props.pollInterval);
	// },