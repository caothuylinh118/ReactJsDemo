import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import '../../../assets/css/index.css'


class UserHeader extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      
    }
    this.props = props;
  } 
  
  render() {
    return (
      <div>
        <header>
            <div className="container">
                <h1 className="logo"><Link to={'/' }><img src={require("../../../assets/img/logo.png")} alt="Hotel"/></Link></h1>
                <div className="header_btn">
                    <div className="user_name">
                        <span><i class="fas fa-user"></i></span>
                        <span>Hello, {this.props.name}</span>
                    </div>
                    <div className="booked_hotel"><Link to={'/hotellist/' }>Booked hotel List</Link></div>
                </div>
            </div>
        </header>
      </div>
    );
  }
}

export default UserHeader
