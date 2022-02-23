import axios from 'axios';
import React from 'react';



class Purchase extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      quantity: 0,
      client: '',
      equipement: '',
      clients: [],
      equipements: [],

    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }
  componentDidMount() {
    this.getClients();
    this.getEquipements();

  }
  handleChange(event) {
    const value = event.target.value;


    this.setState({
      ...this.state,
      [event.target.name]: value
    });

  }

  handleSubmit(event) {
    event.preventDefault();
    this.saveData();
  }
  saveData() {
    axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*',

      axios.post(`http://localhost:8000/api/addPurchase`, { "data": { 'equipement': this.state.equipement, 'client': this.state.client, 'quantity': this.state.quantity } })
        .then((response) => {
          window.location = "/list"
        }, (error) => {
          console.log(error);
        })
  }
  getClients() {
    axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*',

      axios.get(`http://localhost:8000/api/clients/list`).then(res => {

        this.setState({ clients: res.data, loading: false })
      })
  }
  getEquipements() {
    axios.defaults.headers.post['Access-Control-Allow-Origin'] = '*',

      axios.get(`http://localhost:8000/api/equipements/list`).then(res => {

        this.setState({ equipements: res.data, loading: false })
      })
  }

  render() {
    return (
      <div className="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div className="wrapper wrapper--w790">
          <div className="card card-5">
            <div className="card-heading">
              <h2 className="title">Add Purchase Form</h2>
            </div>
            <div className="card-body">
              <form onSubmit={this.handleSubmit}>
                <div className="form-row">
                  <div className="name">Client</div>
                  <div className="value">
                    <div className="input-group">
                        <select  className="input--style-5" name="client" onChange={this.handleChange}>
                        <option key="chooseClient">Choose option</option>
{
                          this.state.clients.map((client) =>
                            <option  value={client.id} key={client.id}>{client.name}</option>)
                        }</select>
                        <div className="select-dropdown"></div>
                      </div>
                    </div>
                </div>
                <div className="form-row">
                  <div className="name">Equipement</div>
                  <div className="value">
                    <div className="input-group">
                        <select   className="input--style-5"  name="equipement" onChange={this.handleChange}>
                          <option key="chooseEquipement">Choose option</option>
                          {    this.state.equipements.map((equipement) =>
                            <option value={equipement.id} key={equipement.id}>{equipement.name}</option>)
                        }</select>
                        <div className="select-dropdown"></div>
                      </div>
                  </div>
                </div>


                <div className="form-row">
                  <div className="name">Quantity</div>
                  <div className="value">
                    <div className="input-group">
                      <input className="input--style-5" name="quantity" type="number"  min="1" value={this.state.quantity} onChange={this.handleChange} />
                    </div>
                  </div>
                </div>
                <button className="btn btn--radius-2 btn--blue float-right text-capitalize" type="submit">Submit</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    );
  }
}
export default Purchase;
