import React, { Component } from 'react';
import { Link } from 'react-router-dom';

import '../../../assets/css/index.css'
import '../../../assets/css/bootstrap.min.css'
import '../../../assets/css/fontAwesome.css'
import '../../../assets/css/owl-carousel.css'
import '../../../assets/css/datepicker.css'
import '../../../assets/css/tooplate-style.css'
import DatePicker from 'react-date-picker'

import Header from '../../public/header/';
import UserHeader from '../../public/header/user_header';
import Common from '../../../common/common';
import ListBlock from './list_block';



class HotelDetail extends Component {
    constructor(props) {
        super(props);
        this.state = {
            
            selectedHotelId: this.props.match.params.id,
            selectedFrom: this.props.match.params.from,
            selectedTo: this.props.match.params.to,
            list_room: [],
            valueCity: '',
            valueCityAfterChange: this.props.match.params.city,
            dateInFormated: this.formatDate(new Date()),
            dateOutFormated: this.formatDate(new Date()),
            hotel_name: '',
            checkIn: this.formatDate(this.props.match.params.from),
            checkOut: this.formatDate(this.props.match.params.to),
            IsLogin: false,
        }
        this.onChangeIn = this.onChangeIn.bind(this);
        this.onChangeOut = this.onChangeOut.bind(this);
        this.HanldeSelectCity = this.HanldeSelectCity.bind(this);
        this.formatDate = this.formatDate.bind(this);
        //this.HanldeRoomCount = this.HanldeRoomCount.bind(this);
        //this.checkRoomCount = this.checkRoomCount.bind(this);

      }

    toggleModal = () => {
    this.setState(state => ({ modalIsOpen: !state.modalIsOpen }));
    }

    onChangeIn(dateIn) {
        this.setState({
            dateIn: dateIn,
            dateInFormated: this.formatDate(dateIn)
        })
        console.log("date: " + this.state.dateIn)
        console.log("Format date: " + this.state.dateInFormated)
    }

    onChangeOut(dateOut) {
        this.setState({
            dateOut: dateOut,
            dateOutFormated: this.formatDate(dateOut)
        })

    }

    checkRoomCount() {
        if (this.state.roomCount == 1) {
            console.log("room count: " + this.state.roomCount)
            var button = document.getElementById("reserve");
            console.log("Button: ");
            console.log(button);
            button.disabled = false;
        }
    }
    componentDidMount() {
        console.log("Call API : " + Common.api + Common.room + '?hotel_id=' + this.state.selectedHotelId + '&from_date=' + this.state.selectedFrom + '&to_date=' + this.state.selectedTo)
        fetch(Common.api + Common.room + '?hotel_id=' + this.state.selectedHotelId + '&from_date=' + this.state.selectedFrom + '&to_date=' + this.state.selectedTo)
        .then(res => res.json())
        .then((data) => {
        console.log(data);
        this.setState({
            list_room: data.data,
            hotel_name: data.hotel.hotel_name

        })
        })
        .catch(console.log)

        this.setState({
            dateIn: new Date(this.props.match.params.from),
            dateOut: new Date(this.props.match.params.to),
            valueCity: this.props.match.params.city,
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
  render() {
    let header;
    if(this.state.IsLogin == false) {
        header = <Header></Header>
     }
     else {
        header = <UserHeader name={this.state.name}></UserHeader>
     }
    return (
       <div>
            {header}
            <section className="search">
                <div className="container">
                    <form id="form-submit" action="" method="get">
                        <fieldset className="search_location">
                            <select required name='from' onChange={this.HanldeSelectCity} value={this.state.valueCity}>
                                <option value="">Select a location...</option>
                                <option value="Tokyo">Tokyo</option>
                                <option value="Osaka">Osaka</option>
                                <option value="Kyoto">Kyoto</option>
                                <option value="Hokkaido">Hokkaido</option>
                                <option value="Hokane">Hokane</option>
                            </select>
                        </fieldset>
                        <fieldset className="search_date">
                            <DatePicker onChange={this.onChangeIn} value={this.state.dateIn}/>
                        </fieldset>
                        <fieldset className="search_date">
                            <DatePicker onChange={this.onChangeOut} value={this.state.dateOut}/>

                        </fieldset>
                        <fieldset className="search_btn">
                            <button type="submit" className="btn"><Link to={'/hotel/list/'+this.state.valueCity+'/'+ this.state.dateInFormated + '/' + this.state.dateOutFormated }>Search Hotel</Link></button>
                        </fieldset>
                    </form>

                </div>
            </section>
            <section className="navigation">
                <div className="container">
                    <ul>
                        <li><Link to={'/home' }>Home</Link><span>></span></li>
                        <li><Link to={'/list' }>Hotels in {this.state.valueCityAfterChange}</Link><span>></span></li>
                        <li>{this.state.hotel_name}</li>
                    </ul>
                </div>
            </section>
            <section className="list_room">
                <div className="container">

                    <div className="room_title">
                        <div className="room-type">Room type</div>
                        <div className="room-name">Room name</div>
                        <div className="room-max">Sleeps</div>
                        <div className="room-price">Price per night</div>
                        <div className="room-count">Rooms</div>
                        <div className="btn">Most booked</div>
                    </div>
                    {this.state.list_room.map((item, index) =>
                    <ListBlock item={item} selectedHotelId={this.state.selectedHotelId} selectedFrom={this.state.selectedFrom} selectedTo={this.state.selectedTo} checkOut={this.state.checkOut} checkIn={this.state.checkIn}></ListBlock>
                    )}

                    </div>
            </section>
       </div>

    )}
}

export default HotelDetail;
