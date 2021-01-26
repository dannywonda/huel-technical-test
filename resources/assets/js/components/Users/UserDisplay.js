import React from 'react';

const UserDisplay = (props) => {
    const users = props.items.data;
     
    const listItems = users.map(user =>
        <tr key={user.id}>
            <td>{user.name}</td>
            <td>{user.email}</td>
            <td>{user.orders_count} order{user.orders_count > 1 ? 's' : ''}</td>
            <td>{user.total_spent}</td>
        </tr>
    );

    return (
        <div className="container p-0">
            <table className="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Order</th>
                    <th>Total Spent</th>
                </tr>
                </thead>
                <tbody>
                    {  listItems}
                </tbody>
            </table>
        </div>
    )
}

export default UserDisplay;