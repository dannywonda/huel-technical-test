import React from 'react';

const getStatsDisplay = (props) => {
     
    return (
        <div className="container">
            <div className="row">
                <div className="col-sm-4">
                    <div className="panel panel-default">
                        <div className="panel-heading">Total Number Of Order</div>
                        <div className="panel-body"> { props.item.totalNoOfOrders } </div>
                    </div>
                </div>
                <div className="col-sm-4">
                    <div className="panel panel-default">
                        <div className="panel-heading">Total Number Of Customer</div>
                        <div className="panel-body"> { props.item.totalNoOfCustomers } </div>
                    </div>
                </div>
                <div className="col-sm-4">
                    <div className="panel panel-default">
                        <div className="panel-heading">Total Number Of Products</div>
                        <div className="panel-body"> { props.item.totalNoOfProducts } </div>
                    </div>
                </div>
            </div>
            <div className="row">
                <div className="col-sm-4">
                    <div className="panel panel-default">
                        <div className="panel-heading">Mean Average Customers Order</div>
                        <div className="panel-body"> { props.item.averageCustomerOrder} </div>
                    </div>
                </div>
                <div className="col-sm-4">
                    <div className="panel panel-default">
                        <div className="panel-heading">Mean Average Paid Customers</div>
                        <div className="panel-body">{ props.item.averageSpecificCustomer}</div>
                    </div>
                </div>
                <div className="col-sm-4">
                    <div className="panel panel-default">
                        <div className="panel-heading">Mean Average Specific Product Variant</div>
                        <div className="panel-body">{props.item.averageSpecificVariant }</div>
                    </div>
                </div>
            </div>
        </div>
    )
}


export default getStatsDisplay;