import React, { Component } from 'react';
import UserHeader from '../../public/header/user_header';


class Finished extends Component {
    constructor(props) {
        super(props);
        this.state = {
            IsLogin: false,
            
            
        }
        
    } 
    componentDidMount() {
        
        var user = sessionStorage.getItem("UserLogin")
            var userObject = JSON.parse(user)
            console.log(userObject !== undefined);
            
            if (userObject !== undefined) {
            this.setState({
                email: userObject.user_email,
                name: userObject.user_name,
                IsLogin: true
            })
        }

      }
  render() {

    return (
        <div>
            <UserHeader name={this.state.name}></UserHeader>
            <div className="customer_info finished_box">
                <p>Thank you for your booking!</p>
                <p>Please enjoy your trip.</p>
            </div>
        </div>
        
        
    
   
    )}
}

export default Finished;
