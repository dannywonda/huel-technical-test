import React from 'react';

const getOrderTable = (props) => {
    const orders = props.items.data;
    const listItems = orders.map(order =>
        <tr key={order.id}>
            <td>{order.name}</td>
            <td>{order.date}</td>
            <td>{order.customer != null ? order.customer.name : '-'}</td>
            <td>{order.total_price}</td>
            <td><span className={"label label-" + order.financial_status.colour}>{order.financial_status.name}</span></td>
            <td><span className={"label label-" + order.fulfillment_status.colour} >{order.fulfillment_status.name}</span></td>
            <td>{order.items}</td>
            <td>
                {order.tags.map(tag => <span key={tag.id} className="label label-primary tag">{tag.name}</span>)}
            </td>
        </tr>
    );
    return (
        <div className="container p-0">
            <table className="table">
                <thead>
                <tr>
                    <th>Order</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Payment</th>
                    <th>Fulfilment</th>
                    <th>Items</th>
                    <th>Tags</th>
                </tr>
                </thead>
                <tbody>
                    { listItems }
                </tbody>
            </table>
        </div>
    )
}


export default getOrderTable;