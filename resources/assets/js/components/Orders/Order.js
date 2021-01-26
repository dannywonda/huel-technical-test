import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Api from '../api'; 
import OrderTable from './OrderTable';

class AboutUs extends Component {
    constructor() {
        super()
        this.state = {
            orders: '',
        }
    }

    async componentDidMount() {
        const orderData = await Api.get('/shopify/orders');
        this.setState({ orders: orderData.data , init:1})
    }

    render() {
        return (
            <div>
                {this.state.init ?  <OrderTable items={ this.state.orders } /> : <div>loading...</div>}
            </div>
        );
    }
}

export default AboutUs;

if (document.getElementById('order')) {
    ReactDOM.render(<AboutUs />, document.getElementById('order'));
}
