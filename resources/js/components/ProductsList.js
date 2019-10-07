import React, {Component, Fragment} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class ProductsList extends Component {
    constructor(props) {
        super(props);

        this.state = {
            items: [],
            query: '',
        };

        this.search = this.search.bind(this);
        this.handleInputChange = this.handleInputChange.bind(this);
    }

    componentDidMount() {
        this.search();
    }

    render() {
        let children = (
            <tr>
                <td colSpan="6" className="text-center text-danger font-weight-bold">
                    Nothing found!
                </td>
            </tr>
        );

        if (this.state.items.length !== 0) {
            children = this.state.items.map(item => {
                let updateOperation = null;

                if ((this.props.userId.trim() !== "" && parseInt(this.props.userId) === item['user_id'] || item['user_id'] === null)) {
                    updateOperation = (
                        <a href={ '/products/' + item['id'] + '/edit' }
                           className="btn btn-sm btn-link float-right py-0">
                            Update
                        </a>
                    );
                }

                return (
                    <tr key={ item['id'] }>
                        <td className="text-right align-middle">{ item['id'] }</td>
                        <td className="w-100 align-middle text-justify">{ item['name'] }</td>
                        <td className="text-right align-middle">{ item['unit'] }</td>
                        <td className="text-right align-middle">{ item['price'] }</td>
                        <td className="text-right align-middle">{ item['quantity'] }</td>
                        <td className="align-middle">
                            <a href={ '/products/' + item['id'] }
                               className="btn btn-sm btn-link float-right py-0">
                                Show
                            </a>
                            { updateOperation }
                        </td>
                    </tr>
                );
            });
        }

        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-10">
                        <div className="input-group">
                            <input type="search"
                                   name="query"
                                   className="form-control"
                                   placeholder="Search"
                                   onChange={ this.handleInputChange }/>

                            <div className="input-group-append">
                                <button className="btn btn-primary" onClick={ this.search }>
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>

                    <div className="col-md-10">
                        <hr/>
                    </div>

                    <div className="col-md-10">
                        <div className="card">
                            <div className="card-header">
                                Products List
                                <a href={ this.props.newItem }
                                   className="btn btn-sm btn-link float-right py-0">
                                    New
                                </a>
                            </div>

                            <div className="card-body p-0">
                                <table className="m-0 table table-striped">
                                    <thead>
                                    <tr>
                                        <th className="text-center">#</th>
                                        <th>Name</th>
                                        <th className="text-center">Unit</th>
                                        <th className="text-center">Price</th>
                                        <th className="text-center">Quantity</th>
                                        <th className="text-center">Operations</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    { children }
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

    search() {
        axios.get('/api/products?q=' + this.state.query)
            .then(response => {
                console.log(response);
                this.setState({
                    items: response.data,
                })
            })
            .catch(error => {
                console.log(error);
            })
        ;
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setState({
            [name]: value
        });
    }
}

if (document.getElementById('products-list')) {
    ReactDOM.render(<ProductsList newItem={
        document.getElementById('products-list').getAttribute('newItemRoute')
    } userId={
        document.getElementById('products-list').getAttribute('userId')
    } />, document.getElementById('products-list'));
}
