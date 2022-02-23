
import React, { Component } from 'react';
import axios from 'axios';
import {baseUrl} from '../app'

class Clients extends Component {
    constructor() {
        super();
        this.state = { clients: [], loading: true };
    }

    componentDidMount() {
        this.getLiens();
    }

    getLiens() {
        axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*',

            axios.get(`http://localhost:8000/api/liens`).then(res => {

                this.setState({ clients: res.data, loading: false })
            })
    }
    render() {

        const loading = this.state.loading;
        return (
            <div className="page-wrapper bg-gra-03 p-t-45 p-b-50">
                <div className="wrapper wrapper--w790">
                    <div className="card card-5">
                        <div className="card-heading">
                            <h2 className="title">List of clients</h2>
                        </div>
                        <div>
                            <section className="row-section">
                                <div className="container">
                                    {loading ? (
                                        <div className='row text-center'>
                                            <span id ="loader" className="fa fa-spin fa-spinner fa-5x"></span>
                                        </div>
                                    ) : (
                                        <>
                                            <div className="table100 ver1">
                                                <div className="table100-head">
                                                    <table>
                                                        <thead>
                                                            <tr className="row100 head">
                                                                <th className="cell100 column1">Client name</th>
                                                                <th className="cell100 column2">Client address</th>
                                                                <th className="cell100 column3">Total (€)</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                                <div className="table100-body ">
                                                    <table>
                                                        <tbody>
                                                            {this.state.clients.map(client =>
                                                                <tr className="row100 body">
                                                                    <td className="cell100 column1">{client.name}</td>
                                                                    <td className="cell100 column2">{client.address}</td>
                                                                    <td className="cell100 column3">{client.totalPrice}</td>
                                                                </tr>
                                                            )}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                        </>
                                    )
                                    }
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default Clients;
