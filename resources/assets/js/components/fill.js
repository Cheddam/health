var Goal = React.createClass({
	handleClick: function() {
		this.props.handleComplete(this.props.id);
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
						<Goal key={goal.id} id={goal.id} name={goal.name} points={goal.points} completed={goal.completed} handleComplete={this.props.handleComplete} />
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
						<Category key={category.name} name={category.name} goals={category.goals} handleComplete={this.props.handleComplete} />
					);
				}, this)}
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
	handleComplete: function(id) {
		$.ajax({
			url: '/goals/complete/' + id,
			dataType: 'json',
			type: 'POST',
			data: {
				'_token': $('meta[name=csrf-token]').attr('content')
			},
			success: function(data) {
				var localCats = this.state.data;

				for (var c = 0; c < localCats.count; c++) {
					for (var g = 0; g < localCats[c].goals.count; g++) {
						if (localCats[c].goals[g].id === data.goal_id) {
							localCats[c].goals[g].completed = true;
						}
					}
				}

				this.setState({data: localCats});
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
				<CategoryList data={this.state.data} handleComplete={this.handleComplete} />
			</div>
		);
	}
});

ReactDOM.render(
	<GoalInterface pollInterval={2000} />,
	document.getElementById('goals')
)