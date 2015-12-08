'use strict';

var Goal = React.createClass({
	displayName: 'Goal',

	handleClick: function handleClick() {
		this.props.handleComplete(this.props.id);
	},
	render: function render() {
		return React.createElement(
			'div',
			{ className: this.props.completed ? 'goal goal-completed' : 'goal', onClick: this.handleClick },
			React.createElement(
				'span',
				{ className: 'goal-points' },
				this.props.points
			),
			this.props.name
		);
	}
});

var Category = React.createClass({
	displayName: 'Category',

	render: function render() {
		return React.createElement(
			'div',
			{ className: 'category' },
			React.createElement(
				'h4',
				null,
				this.props.name
			),
			this.props.goals.map(function (goal) {
				return React.createElement(Goal, { key: goal.id, id: goal.id, name: goal.name, points: goal.points, completed: goal.completed, handleComplete: this.props.handleComplete });
			}, this)
		);
	}
});

var CategoryList = React.createClass({
	displayName: 'CategoryList',

	render: function render() {
		return React.createElement(
			'div',
			{ className: 'category-list' },
			this.props.data.map(function (category) {
				return React.createElement(Category, { key: category.name, name: category.name, goals: category.goals, handleComplete: this.props.handleComplete });
			}, this)
		);
	}
});

var GoalInterface = React.createClass({
	displayName: 'GoalInterface',

	loadGoalsFromServer: function loadGoalsFromServer() {
		$.ajax({
			url: '/goals/list',
			dataType: 'json',
			cache: false,
			success: (function (data) {
				this.setState({ data: data });
			}).bind(this),
			error: (function (xhr, status, err) {
				console.error(this.props.url, status, err.toString());
			}).bind(this)
		});
	},
	handleComplete: function handleComplete(id) {
		$.ajax({
			url: '/goals/complete/' + id,
			dataType: 'json',
			type: 'POST',
			data: {
				'_token': $('meta[name=csrf-token]').attr('content')
			},
			success: (function (data) {
				var localCats = this.state.data;

				for (var c = 0; c < localCats.count; c++) {
					for (var g = 0; g < localCats[c].goals.count; g++) {
						if (localCats[c].goals[g].id === data.goal_id) {
							localCats[c].goals[g].completed = true;
						}
					}
				}

				this.setState({ data: localCats });
			}).bind(this),
			error: (function (xhr, status, err) {
				console.error(this.props.url, status, err.toString());
			}).bind(this)
		});
	},
	getInitialState: function getInitialState() {
		return { data: [] };
	},
	componentDidMount: function componentDidMount() {
		this.loadGoalsFromServer();
		setInterval(this.loadGoalsFromServer, this.props.pollInterval);
	},
	render: function render() {
		return React.createElement(
			'div',
			{ className: 'pure-u-1 goal-interface' },
			React.createElement(CategoryList, { data: this.state.data, handleComplete: this.handleComplete })
		);
	}
});

ReactDOM.render(React.createElement(GoalInterface, { pollInterval: 2000 }), document.getElementById('goals'));
//# sourceMappingURL=all.js.map
