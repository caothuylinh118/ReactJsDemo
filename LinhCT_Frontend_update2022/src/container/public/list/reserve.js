import React, { Component } from 'react';
import { Link,useParams, useNavigate } from 'react-router-dom';
import Header from '../../public/header/';


import '../../../assets/css/index.css'
import '../../../assets/css/bootstrap.min.css'
import '../../../assets/css/fontAwesome.css'
import '../../../assets/css/owl-carousel.css'
import '../../../assets/css/datepicker.css'
import '../../../assets/css/tooplate-style.css'

import ReserveNav from './reserve_nav'
import ReserveCustomer from './reserve_customer'
import ReserveRoom from './reserve_room'
import ConfirmCustomer from './confirm_customer'
import UserHeader from '../../public/header/user_header';
import LoginBlock from './login_block';

function withParams(Component) {
  return props => <Component {...props} params={useParams()} navigate={useNavigate()} />;
}

class Reserve extends Component {
    constructor(props) {
        super(props);
        this.state = {
            checkIn: "",
            checkOut: "",
            duration: '',
            roomId: "",
            step: 1,
            IsLogin: false,
        }
        this.handleStep = this.handleStep.bind(this);
        this.finishedParent = this.finishedParent.bind(this);
        this.handleLogin = this.handleLogin.bind(this)
      } 
      
      handleStep(step, email, name, phone) {
          console.log(step);
          
        this.setState({
          step: step,
          email: email,
          name: name,
          phone: phone
        })
      }
      handleLogin(email, password, user) {
        sessionStorage.setItem("UserLogin",JSON.stringify(user));
        this.setState({
          email: email,
          password: password,
          name: user.name,
          IsLogin: true,
        })
        

      }
      finishedParent() {
        var navigate = this.props.navigate
        navigate("/list/finished");
      }
      componentDidMount() {
        const { hotelId } = this.props.params;
        const { from } = this.props.params;
        const { to } = this.props.params;
        const { roomId } = this.props.params;

        this.setState({
            roomId: roomId,
            checkIn: from,
            checkOut: to,
        })

        var user = sessionStorage.getItem("UserLogin")
            var userObject = JSON.parse(user)
            console.log(userObject !== undefined);
            
            if (userObject !== undefined && userObject !== null) {
            this.setState({
                email: userObject.user_email,
                name: userObject.user_name,
                IsLogin: true
            })
        }

      }
  render() {
    let confirm;
    let nav;
    let header;
    if(this.state.IsLogin == false) {
        header = <Header></Header>
     }
     else {
        header = <UserHeader name={this.state.name}></UserHeader>
     }
    if(this.state.step == 1) {
        nav = <ReserveNav classStep1="active"></ReserveNav>
        if (this.state.IsLogin == true) {
          confirm = <ReserveCustomer clickButton={this.handleStep} ></ReserveCustomer>
        }
        else if(this.state.IsLogin == false) {
          confirm = <LoginBlock clickLoginButton={this.handleLogin} ></LoginBlock>
        }
       
    }
    else if (this.state.step == 2) {
        nav = <ReserveNav classStep1="active finished" classStep2="active"></ReserveNav>
        confirm = <ConfirmCustomer name={this.state.name} email={this.state.email} phone={this.state.phone} roomId={this.state.roomId} from={this.state.checkIn} to={this.state.checkOut} count={this.state.duration}  finished={this.finishedParent} ></ConfirmCustomer>
    }

    return (
        <div>
            {header}
            {nav}
            <section className="reserve_main">
              <div className="container">
                {confirm}
                <ReserveRoom roomId={this.state.roomId} checkIn={this.state.checkIn} checkOut={this.state.checkOut}></ReserveRoom>
                
              </div>
            </section>
        </div>
   
    )}
}

export default withParams(Reserve);
