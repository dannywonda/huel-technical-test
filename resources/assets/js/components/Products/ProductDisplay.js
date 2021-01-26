import React from 'react';

const ProductDisplay = (props) => {
    const products = props.items.data;
    console.log(products);
    const listItems = products.map(product =>
        <tr key={product.id}>
            <td>{product.name}</td>
            <td><span className={"label label-" + product.status.colour}>{product.status.name}</span></td>
            <td>Inventory</td>
            <td>{product.product_type != null ? product.product_type : '-'}</td>
            <td>{product.vendor}</td>
            <td>{product.variants}</td>
            <td width="200">
                <div class="row">
                    {product.tags.map(tag => <span key={tag.id} className="col-sm-12 label label-primary tag">{tag.name}</span>)}
                </div>
            </td>
           
        </tr>
    );
    return (
        <div className="container p-0">
            <table className="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Inventory</th>
                    <th>Product Type</th>
                    <th>Vendor</th>
                    <th>Variant</th>
                    <th>Tags</th>
                </tr>
                </thead>
                <tbody>
                    {listItems}
                </tbody>
            </table>
        </div>
    )
}

export default ProductDisplay;