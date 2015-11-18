var data = [
	{
		name: 'Basic Tasks',
		goals: [
			{ id: 1, name: 'Slept 6-8 hours last night', points: 10, completed: false },
			{ id: 2, name: 'Exercised for at least 30 mins', points: 10, completed: true }
		]
	}
];

var Goal = React.createClass({
	// TODO: Move this to GoalInterface, make feedback instant
	handleComplete: function(e) {
		$.ajax({
			url: '/goals/complete/' + this.props.id,
			dataType: 'json',
			type: 'POST',
			data: {
				'_token': $('meta[name=csrf-token]').attr('content')
			},
			error: function(xhr, status, err) {
				console.error(this.props.url, status, err.toString());
			}.bind(this)
		});
	},
	render: function() {
		return (
			<div className={this.props.completed ? 'goal goal-completed' : 'goal'} onClick={this.handleComplete}>
				<span className="goal-points">{this.props.points}</span>
				{this.props.name}
			</div>
		);
	}
});

var Category = React.createClass({
	render: function() {
		var goals = this.props.goals.map(function(goal) {
			return (
				<Goal key={goal.id} id={goal.id} name={goal.name} points={goal.points} completed={goal.completed} />
			);
		})

		return (
			<div className="category">
				<h4>{this.props.name}</h4>
				{goals}
			</div>
		);
	}
});

var CategoryList = React.createClass({
	render: function() {
		var categories = this.props.data.map(function(category) {
			return (
				<Category key={category.name} name={category.name} goals={category.goals} />
			);
		});

		return (
			<div className="category-list">
				{categories}
			</div>
		);
	}
});

var GoalInterface = React.createClass({
	loadGoalsFromServer: function() {
		$.ajax({
			url: '/goals/list',
			dataType: 'json',
			cache: false,
			success: function(data) {
				this.setState({data: data});
			}.bind(this),
			error: function(xhr, status, err) {
				console.error(this.props.url, status, err.toString());
			}.bind(this)
		});
	},
	getInitialState: function() {
		return {data: []};
	},
	componentDidMount: function() {
		this.loadGoalsFromServer();
		setInterval(this.loadGoalsFromServer, this.props.pollInterval);
	},
	render: function() {
		return (
			<div className="pure-u-1 goal-interface">
				<CategoryList data={this.state.data} />
			</div>
		);
	}
});

ReactDOM.render(
	<GoalInterface pollInterval={2000} />,
	document.getElementById('goals')
);