
import React, { Component } from 'react';
import { Link, Route, Routes } from 'react-router-dom';
import Clients from './Clients';
import Purchase from './Purchase';

class Home extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-light bg-light">
                    <Link className={"navbar-brand"} to={"/"}>Softeam Test </Link>
                    <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav  mr-auto">
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/purchase"}> Purchase </Link>
                            </li>

                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/list"}> Clients </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <Routes>
                    <Route exact from="/" to="/list" />
                    <Route path="/list" element={<Clients />}></Route>
                    <Route path="/purchase" element={<Purchase />}></Route>

                </Routes>
                <div className="page-wrapper bg-gra-03 p-t-45 p-b-50">
                    <div className="wrapper wrapper--w790">
                        <div className="card card-5">            <div className="card-heading">
                            <h2 className="title"></h2>
                        </div>
                            <div className="card-body">
                            <div className="container">

                                <p>
                                    /purchase : to add a new purchase by choosing one client , one equipement and the quantity needed.
                                    <hr />
                                    /list : to show the list of clients who had purchase  more than 30 equipement and the total sold are more than 30000 € .
                                </p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Home;
