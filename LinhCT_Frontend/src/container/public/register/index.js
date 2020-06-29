import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Header from '../../public/header/';

import Common from '../../../common/common';

import '../../../assets/css/index.css'
import '../../../assets/css/bootstrap.min.css'
import '../../../assets/css/fontAwesome.css'
import '../../../assets/css/owl-carousel.css'
import '../../../assets/css/datepicker.css'
import '../../../assets/css/tooplate-style.css'
import $ from 'jquery';

class Register extends Component {
  constructor(props) {
    super(props);
    this.state = {
        name: '',
        email: '',
        password: '',
       
    }
    this.onChange = this.onChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);

  } 
  onChange(e) {
    if (e.target.id === 'name') {
        this.setState({ name: e.target.value });
    } else if (e.target.id === 'email') {
        this.setState({ email: e.target.value });
    } else if (e.target.id === 'password') {
        this.setState({ password: e.target.value });
    } 
}



  handleSubmit = event =>{
    event.preventDefault();
    const url = Common.api + '/users/create'
    const data = { 'user_name':this.state.name, 'user_email':this.state.email, 'password':this.state.password }
    console.log(data)
    
    var history = this.props.history

    $.ajax({
      method: "POST",
      url: url,
      data: data
    })
    .done(function( result ) {
      console.log(result);
      result = JSON.parse(result);
      
      if (result.result_code == "success") {
        sessionStorage.setItem("email", result.data.user_email);
        history.push("../login/");
      }
    });
    
    
  }
  render() {

    return (
        <div>
            <Header></Header>
            <section className="navigation">
                <div className="container">
                    <ul>
                        <li><Link to={'/home' }>Home</Link><span>></span></li>
                        <li>Register</li>
                    </ul>
                </div>
            </section>
            <section>
              <div className="container">
                <form id="login" action="#" method="post">
                    <fieldset>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Input your name" required="" value = { this.state.name } onChange = { this.onChange }/>
                  </fieldset>
                  <fieldset>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Input your email" required="" value = { this.state.email } onChange = { this.onChange }/>
                  </fieldset>
                  <fieldset>
                    <input name="pass" type="text" class="form-control" id="password" placeholder="Input password" required="" value = { this.state.password } onChange = { this.onChange }/>
                  </fieldset>
                  <fieldset>
                      <button type="submit" id="form-submit" class="btn" onClick={this.handleSubmit}>Register</button>
                  </fieldset>
                </form>
                
              </div>
            </section>
        </div>
   
    )}
}

export default Register;
