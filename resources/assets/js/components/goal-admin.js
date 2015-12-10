var $ = require('jquery');
var React = require('react');
var ReactDOM = require('react-dom');
var Redux = require('redux');
require('../helpers/assign');

var csrf = $('meta[name=csrf-token]').attr('content');

var GoalEditor = React.createClass({

    render: function() {
        return (
            <div className="goal goal-editor">
                <input type="text" value="{this.props.points}" onBlur={this.finishEditing} />
                <input type="text" value="{this.props.name}" onBlur={this.finishEditing} />
            </div>
        );
    }
});

var GoalViewer = React.createClass({
    render: function() {
        return (
            <div className="goal">
                <span onClick={this.beginEditing}>{this.props.points}</span>
                <span onClick={this.beginEditing}>{this.props.name}</span>
            </div>
        );
    }
});

var Goal = React.createClass({
    render: function() {
        comp = this.props.editing ?
            <GoalEditor id={this.props.id} points={this.props.points} name={this.props.name} /> :
            <GoalViewer id={this.props.id} points={this.props.points} name={this.props.name} />;

        return comp;
    }
});

var GoalList = React.createClass({
    goals: function() {
        return this.props.goals.map(function() {
            return (
                <Goal key={this.props.id} id={this.props.id} editing={isGoalCurrentlyEditable(this.prop.id)} />
            );
        })
    },
    render: function() {
        <div className="goal-list">
            {this.goals}
        </div>
    }
});

var EditGoalInterface = React.createClass({
    render: function() {
        return (
            <div className="edit-goal-interface">
                <CategoryList categories={store.getState().categories} />
                <GoalList goals={store.getState().goals} />
            </div>
        );
    }
});