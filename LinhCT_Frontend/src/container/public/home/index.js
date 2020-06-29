import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import '../../../assets/css/index.css'
import '../../../assets/css/bootstrap.min.css'
import '../../../assets/css/fontAwesome.css'
import '../../../assets/css/owl-carousel.css'
import '../../../assets/css/datepicker.css'
import '../../../assets/css/tooplate-style.css'
import DatePicker from 'react-date-picker'
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';

import Common from '../../../common/common';

class Home extends Component {
  constructor(props) {
    super(props);
    this.state = {
      dateIn: new Date(),
      dateOut: new Date(),
      dateInFormated: this.formatDate(new Date()),
      dateOutFormated: this.formatDate(new Date()),
      recommended_hotel: {},
      valueCity: '',
      IsFromLogin: false,

    }
    this.selectedCity = this.selectedCity.bind(this);
    this.HanldeSelectCity = this.HanldeSelectCity.bind(this);
    this.formatDate = this.formatDate.bind(this);
    this.onChangeIn = this.onChangeIn.bind(this);
    this.onChangeOut = this.onChangeOut.bind(this);
    this.logout = this.logout.bind(this);
  } 
  

  componentDidMount() {
    fetch(Common.api + Common.recommended_hotel + '?city=Tokyo&limit=1')
    .then(res => res.json())
    .then((data) => {
      console.log(data);
      this.setState({
        recommended_hotel: data.data[0],

      })
    })
    .catch(console.log)

    var user = sessionStorage.getItem("UserLogin")
    var userObject = JSON.parse(user)
    console.log(userObject !== undefined);
    
    if (userObject !== undefined && userObject !== null) {
      this.setState({
        email: userObject.user_email,
        name: userObject.user_name,
        IsFromLogin: true
      })
    }
    
    
  }

  onChangeIn(dIn) {
    this.setState({ 
      dateIn: dIn,
      dateInFormated: this.formatDate(dIn)
    })

  }

  onChangeOut(dOut) {
    this.setState({ 
      dateOut: dOut,
      dateOutFormated: this.formatDate(dOut)
    })

  }

  selectedCity(event) {
    var city = event.target.attributes.getNamedItem('data-city').value;
    console.log("API: " + Common.api + Common.recommended_hotel + '?city='+ city +'&limit=1');
    
    fetch(Common.api + Common.recommended_hotel + '?city='+ city +'&limit=1')
    .then(res => res.json())
    .then((data) => {
      console.log(data);
      this.setState({
        recommended_hotel: data.data[0],

      })
    })
    .catch(console.log)
  }

  HanldeSelectCity(event) {
    this.setState({valueCity: event.target.value})
  }
  formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

logout() {
  sessionStorage.removeItem('UserLogin');
  window.location.reload();
}
  render() {
    let user;
    const today = new Date();
    if(this.state.IsFromLogin == false) {
      user = <div>
       <div className="register-button page-direction-button">
                      <Link to={'/register/' }>Register</Link>
                      </div>
                      <div className="login-button page-direction-button">
                          <Link to={'/login/' }>Login Now</Link>
                      </div>
    </div>
    }
    if(this.state.IsFromLogin == true) {
      user = <div className="User_IsLogined">
       <p>Hello, {this.state.name}</p>
       <p><Link to={'/hotellist' }>Booked Hotel List</Link></p>
      <button type="submit" className="btn_out btn" onClick={this.logout}>Sign out</button>
    </div>
    }
    return (
      <div>
        
        <section className="banner" id="top">
          <div className="container">
            <div className="row">
              <div className="col-md-5">
                  <div className="left-side">
                      <div className="logo">
                          <img src={require("../../../assets/img/logo.png")} alt="Hotel"/>
                      </div>
                            
                     {user}
                      
                    </div>
                </div>
                <div className="col-md-5 col-md-offset-1">
                    <section id="first-tab-group" className="tabgroup">
                        <div id="tab1">
                            <div className="submit-form">
                                <h4>Check availability hotel:</h4>
                                <form id="form-submit" action="" method="get">
                                    <div className="row">
                                        <div className="col-md-12">
                                            <fieldset>
                                                <label for="from">City:</label>
                                                <select required name='from' onChange={this.HanldeSelectCity} value={this.state.valueCity}>
                                                    <option value="">Select a location...</option>
                                                    <option value="Tokyo">Tokyo</option>
                                                    <option value="Osaka">Osaka</option>
                                                    <option value="Kyoto">Kyoto</option>
                                                    <option value="Hokkaido">Hokkaido</option>
                                                    <option value="Hokane">Hokane</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        
                                        <div className="col-md-6">
                                            <fieldset>
                                                <label for="departure">Check-in date:</label>
                                                <DatePicker onChange={this.onChangeIn} value={this.state.dateIn} />
                                            </fieldset>
                                        </div>
                                        <div className="col-md-6">
                                            <fieldset>
                                                <label for="return">Check-out date:</label>
                                                <DatePicker onChange={this.onChangeOut} value={this.state.dateOut} minDate={today} />

                                            </fieldset>
                                        </div>

                                        <div className="col-md-6">
                                            <fieldset>
                                                <button type="submit" id="form-submit" className="btn"><Link to={'hotel/list/'+this.state.valueCity+'/'+ this.state.dateInFormated + '/' + this.state.dateOutFormated }>
                                                Book room Now
                                </Link></button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
          </div>
        </section>
    <section className="tabs-content" id="recommended-hotel">
        <div className="container">
          <div className="row">
              <div className="col-md-12">
                  <div className="section-heading">
                      <h2>Recommended Hotel For You</h2>
                  </div>
              </div>
              <Tabs className="wrapper">
                <div className="col-md-4">
                <TabList className="tabs clearfix">
                  <Tab data-city="tokyo" className="tabs_name" onClick={this.selectedCity}>Tokyo</Tab>
                  <Tab data-city="osaka" className="tabs_name" onClick={this.selectedCity}>Osaka</Tab>
                  <Tab data-city="kyoto" className="tabs_name" onClick={this.selectedCity}>Kyoto</Tab>
                  <Tab data-city="hokkaido" className="tabs_name" onClick={this.selectedCity}>Hokkaido</Tab>
                  <Tab data-city="hakone" className="tabs_name" onClick={this.selectedCity}>Hakone</Tab>
                  <Tab data-city="nagoya" className="tabs_name" onClick={this.selectedCity}>Nagoya</Tab>
                </TabList>
                </div>
                <div className="col-md-8">
                <TabPanel>
                  
                  <img  src={this.state.recommended_hotel.hotel_image} alt=""/>
                  <div className="row">
                      <div className="col-md-12">
                          <div className="text-content">
                              <h4>{this.state.recommended_hotel.hotel_name}</h4>
                              <span>{this.state.recommended_hotel.hotel_address}</span>
                          </div>
                      </div>
                  </div>
                </TabPanel>
                <TabPanel>
                  <img  src={this.state.recommended_hotel.hotel_image} alt=""/> 
                  <div className="row">
                    <div className="col-md-12">
                        <div className="text-content">
                          <h4>{this.state.recommended_hotel.hotel_name}</h4>
                          <span>{this.state.recommended_hotel.hotel_address}</span>
                        </div>
                    </div>
                  </div>
                </TabPanel>
                <TabPanel>
                  <img  src={this.state.recommended_hotel.hotel_image} alt=""/>
                  <div className="row">
                      <div className="col-md-12">
                          <div className="text-content">
                              <h4>{this.state.recommended_hotel.hotel_name}</h4>
                              <span>{this.state.recommended_hotel.hotel_address}</span>
                          </div>
                      </div>
                  </div>
                </TabPanel>
                <TabPanel>
                <img  src={this.state.recommended_hotel.hotel_image} alt=""/>
                  <div className="row">
                    <div className="col-md-12">
                        <div className="text-content">
                          <h4>{this.state.recommended_hotel.hotel_name}</h4>
                          <span>{this.state.recommended_hotel.hotel_address}</span>
                        </div>
                    </div>
                  </div>
                </TabPanel>
                <TabPanel>
                <img  src={this.state.recommended_hotel.hotel_image} alt=""/>
                  <div className="row">
                    <div className="col-md-12">
                        <div className="text-content">
                          <h4>{this.state.recommended_hotel.hotel_name}</h4>
                          <span>{this.state.recommended_hotel.hotel_address}</span>
                        </div>
                    </div>
                  </div>
                </TabPanel>
                <TabPanel>
                <img  src={this.state.recommended_hotel.hotel_image} alt=""/>
                  <div className="row">
                    <div className="col-md-12">
                        <div className="text-content">
                          <h4>{this.state.recommended_hotel.hotel_name}</h4>
                           <span>{this.state.recommended_hotel.hotel_address}</span>
                        </div>
                    </div>
                  </div>
                </TabPanel>
                </div>
              </Tabs>
            </div>
        </div>
      </section>
      </div>
      );
  }
}

export default Home;
