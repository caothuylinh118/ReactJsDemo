import React, { Component } from 'react';
import Common from '../../../common/common';
import $ from 'jquery';

class LoginBlock extends Component {
    constructor(props) {
        super(props);
        this.state = {
            email: '',
            password: '',
        }

        this.props = props;
        this.onChange = this.onChange.bind(this);
        this.handleLogin = this.handleLogin.bind(this);

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
        
        var history = this.props.history
        var stateEmail = this.state.email
        var statePass = this.state.password
        var props = this.props
        $.ajax({
          method: "POST",
          url: url,
          data: data
        })
        .done(function( result ) {
          console.log(result);
          result = JSON.parse(result);
          
          if (result.result_code == "success") {
            props.clickLoginButton(stateEmail, statePass, result.user);
            
          }
        });
        
        
      }
    render() {
        
        return ( 
            <div className="customer_info">
                <h3>Please login: </h3>
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
                
        );
    }
}
export default LoginBlock;