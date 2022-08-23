import React, { Component } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import Header from '../../public/header/';

import Common from '../../../common/common';

import '../../../assets/css/index.css'
import '../../../assets/css/bootstrap.min.css'
import '../../../assets/css/fontAwesome.css'
import '../../../assets/css/owl-carousel.css'
import '../../../assets/css/datepicker.css'
import '../../../assets/css/tooplate-style.css'

import $ from 'jquery';

function withParams(Component) {
  return props => <Component {...props} navigate={useNavigate()} />;
}

class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
        
        email: '',
        password: '',
        IsFromRegister: false,
       
    }
    this.handleLogin = this.handleLogin.bind(this);
    this.onChange = this.onChange.bind(this);


  } 
  componentDidMount() {
    var email = sessionStorage.getItem("email")
    if (email != null) {
      this.setState({
        email: email,
        IsFromRegister: true
      })
    }

    sessionStorage.removeItem('email');

    console.log(sessionStorage.getItem("email"))
  }

  onChange(e) {
    if (e.target.id === 'email') {
        this.setState({ email: e.target.value });
    } else if (e.target.id === 'password') {
        this.setState({ password: e.target.value });
    } 
}

  handleLogin = event =>{
    event.preventDefault();
    const url = Common.api + '/users/login'
    const data = {'email':this.state.email, 'password':this.state.password }
    console.log(data)
    
    // var history = this.props.history
    var navigate = this.props.navigate

    $.ajax({
      method: "POST",
      url: url,
      data: data
    })
    .done(function( result ) {
      console.log(result);
      result = JSON.parse(result);
      
      if (result.result_code == "success") {
        alert("Thank you for login")
        sessionStorage.setItem("UserLogin",JSON.stringify(result.user));
        setTimeout(function() {
          // history.push("../")
          navigate("../")
        }, 2000
        )
        
      }
    });
    
    
  }
  render() {
    let notice;
    if(this.state.IsFromRegister == true) {
      notice = <div className="notice">
      <p>Thank you for your Register</p>
      <p>Please Login!</p>
    </div>
    }
    return (
        <div>
            <Header></Header>
            <section className="navigation">
                <div className="container">
                    <ul>
                        <li><Link to={'/home' }>Home</Link><span>></span></li>
                        <li>Login</li>
                    </ul>
                </div>
            </section>
            <section>
              <div className="container">
               {notice}
              
                <form id="login" action="#" method="post">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="email" placeholder="Input your email" required="" value={this.state.email} onChange = { this.onChange }/>
                  </fieldset>
                  <fieldset>
                    <input name="pass" type="text" class="form-control" id="password" placeholder="Input password" required="" value={this.state.password} onChange = { this.onChange }/>
                  </fieldset>
                  <fieldset>
                      <button type="submit" id="form-submit" class="btn" onClick={this.handleLogin}>Login</button>
                  </fieldset>
                </form>
                
              </div>
            </section>
        </div>
   
    )}
}

export default withParams(Login);
