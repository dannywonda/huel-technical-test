import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Api from '../api';
import ProductDisplay from './ProductDisplay';

class Products extends Component {
    constructor() {
        super()
        this.state = {
            products: '',
            init: 0
        } 
    }

    async componentDidMount() {
        const productsData = await Api.get('/shopify/products');
        this.setState({ products: productsData.data , init:1})
    }

    render() {
        return (
            <div>
                {this.state.init ?  <ProductDisplay items={ this.state.products } /> : <div>loading...</div>}
            </div>
        );
    }
}

export default Products;

if (document.getElementById('products')) {
    ReactDOM.render(<Products />, document.getElementById('products'));
}
