var $ = require('jquery');
var React = require('react');
var ReactDOM = require('react-dom');
var Redux = require('redux');
require('../helpers/assign');

// Components

var LeaderboardEntry = React.createClass({
	render: function() {
		return (
			<div className="leaderboard-entry">
				<span>{this.props.name}</span>
				<span className="leaderboard-entry-points pull-right">{this.props.points}</span>
			</div>
		);
	}
});

var LeaderboardEntryList = React.createClass({
	entryList: function(entry) {
		return (
			<LeaderboardEntry name={entry.name} points={entry.points} />
		);
	},
	render: function() {
		return (
			<div className="leaderboard-entry-list">
				{this.props.list.map(this.entryList)}
			</div>
		);
	}
});

var Leaderboard = React.createClass({
	render: function() {
		return (
			<div className="leaderboard">
				<h3>{this.props.name}</h3>
				<LeaderboardEntryList list={this.props.list} />
			</div>
		);
	}
});

var LeaderboardList = React.createClass({
	leaderboardList: function(leaderboard) {
		return (
			<Leaderboard name={leaderboard.name} list={leaderboard.list} />
		);
	},
	render: function() {
		return (
			<div className="leaderboard-list">
				{this.props.leaderboards.map(this.leaderboardList)}
			</div>
		);
	}
});

var LeaderboardInterface = React.createClass({
	render: function() {
		return (
			<div className="pure-u-1 leaderboard-interface">
				<LeaderboardList leaderboards={this.props.leaderboards} />
			</div>
		);
	}
});

// Model

var leaderboards = function(state, action) {
	if (typeof state === 'undefined') {
		return [];
	}

	switch (action.type) {
		case 'ADD_LEADERBOARDS':
			return state.concat(action.leaderboards);
		default:
			return state;
	}
}

var leaderboardApp = function(state, action) {

	if (typeof state === 'undefined') {
		return {leaderboards: []};
	}

	return {
		leaderboards: leaderboards(
			state.leaderboards,
			action
		)
	}

}

// Initialization

var app = Redux.combineReducers({ leaderboardApp });

var store = Redux.createStore(app);

$.ajax({
	url: '/stats/leaderboards/all',
	dataType: 'json',
	cache: false,
	success: function(data) {
		store.dispatch({
			type: 'ADD_LEADERBOARDS',
			leaderboards: data
		});
	},
	error: function(xhr, status, err) {
		console.error('leaderboard retrieval: ', status, err.toString());
	}
});

var render = function() {

	ReactDOM.render(
		<LeaderboardInterface leaderboards={store.getState().leaderboardApp.leaderboards} />,
		document.getElementById('leaderboards')
	);

}

store.subscribe(render);
render();