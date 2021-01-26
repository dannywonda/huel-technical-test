import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Api from '../api';
import UserDisplay from './UserDisplay';

class Users extends Component {
    constructor() {
        super()
        this.state = {
            users: '',
            init: 0
        } 
    }

    async componentDidMount() {
        const usersData = await Api.get('/shopify/customers');
        this.setState({ users: usersData.data , init:1})
    }

    render() {
        return (
            <div>
                {this.state.init ?  <UserDisplay items={ this.state.users } /> : <div>loading...</div>}
            </div>
        );
    }
}

export default Users;

if (document.getElementById('users')) {
    ReactDOM.render(<Users />, document.getElementById('users'));
}
