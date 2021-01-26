import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Api from '../api'
import StatsDisplay from './StatsDisplay'

class Stats extends Component {
    constructor() {
        super()
        this.state = {
            stats: '',
            init: 0
        } 
    }

    async componentDidMount() {
        const stats = await Api.get('/shopify/stats');
        this.setState({ stats: stats.data , init:1})
    }

    render() {
        return (
            <div>
                {this.state.init ?  <StatsDisplay item={ this.state.stats } /> : <div>loading...</div>}
            </div>
        );
    }
}

export default Stats;

if (document.getElementById('stats')) {
    ReactDOM.render(<Stats />, document.getElementById('stats'));
}
