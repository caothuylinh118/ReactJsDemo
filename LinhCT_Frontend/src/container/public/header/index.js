import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import '../../../assets/css/index.css'


class Header extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      
    }
  } 
  
  render() {
    return (
      <div>
        <header>
            <div className="container">
                <h1 className="logo"><Link to={'/' }><img src={require("../../../assets/img/logo.png")} alt="Hotel"/></Link></h1>
                <div className="header_btn">
                    <div className="header_btn-login"><Link to={'/login/' }>Login Now</Link></div>
                    <div className="header_btn-reg"><Link to={'/register/' }>Register</Link></div>
                </div>
            </div>
        </header>
      </div>
    );
  }
}

export default Header
