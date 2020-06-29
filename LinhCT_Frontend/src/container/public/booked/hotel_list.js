import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import '../../../assets/css/index.css'
import '../../../assets/css/bootstrap.min.css'
import '../../../assets/css/fontAwesome.css'
import '../../../assets/css/owl-carousel.css'
import '../../../assets/css/datepicker.css'
import '../../../assets/css/tooplate-style.css'
import Carousel, { Modal, ModalGateway } from 'react-images';
import DatePicker from 'react-date-picker'

import Header from '../../public/header/';
import UserHeader from '../../public/header/user_header';
import Common from '../../../common/common';



class HotelList extends Component {
    constructor(props) {
        super(props);
        this.state = {
            IsLogin: false,
            booked_hotel: []
            
        }
        
    } 

    componentDidMount() {
        var user = sessionStorage.getItem("UserLogin")
            var userObject = JSON.parse(user)
            console.log(userObject !== undefined);
            
            if (userObject !== undefined) {
            this.setState({
                name: userObject.user_name,
                email: userObject.user_email,
                IsLogin: true
            })
        }

        fetch(Common.api + "/book/list?user_email=" + userObject.user_email)
        .then(res => res.json())
        .then((data) => {
            console.log(data);
            this.setState({
                booked_hotel: data.data

            })
        })
        .catch(console.log)

        
      
    
      }


  render() {
    
    return (
       <div>
            <UserHeader name={this.state.name}></UserHeader>
            <div className="container">
                <table className="booked_room">
                    <tr>
                        <th>Hotel name</th>
                        <th>Address</th>
                        <th>Room name</th>
                        <th>Check in</th>
                        <th>Check out</th>
                    </tr>
                    {this.state.booked_hotel.map((item, index) =>
                    <tr key={index}>
                        <td>{item.hotel_name}</td>
                        <td>{item.hotel_address}</td>
                        <td>{item.room_name}</td>
                        <td>{item.from_date}</td>
                        <td>{item.to_date}</td>
                    </tr>
                    )}
                </table>
            </div>
            
   
       </div>
       
    )}
}

export default HotelList;
