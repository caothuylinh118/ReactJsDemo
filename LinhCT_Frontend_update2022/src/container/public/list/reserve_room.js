import React, { Component } from 'react';
import Common from '../../../common/common';

class ReserveRoom extends Component {
    constructor(props) {
        super(props);
        this.state = {
            hotelName: '',
            hotelAddress: '',
            roomType: '',
            roomPrice: '',
            TotalPrice: '',
        }

        this.props = props;
        this.PriceCal = this.PriceCal.bind(this);
        this.durationCal = this.durationCal.bind(this);

    }
     
    componentDidMount() {
        this.setState({
            duration: this.durationCal(),
            
            
        })
        

        fetch(Common.api + '/room/info?room_id=' + this.props.roomId)
        .then(res => res.json())
        .then((data) => {
        console.log(data);
        this.setState({
            hotelName: data.data.hotel.hotel_name,
            hotelAddress: data.data.hotel.hotel_address,
            roomType: data.data.room.room_type,
            roomPrice: data.data.room.room_price,

        })
        this.setState({
            TotalPrice: this.PriceCal(),
        })
    
        })
        .catch(console.log)


      }
      PriceCal() {
        var Price = this.state.roomPrice;
        var diffDays = this.state.duration;
        var TotalPrice = Price*diffDays;
        return TotalPrice;
        
      }

      durationCal() {
        const date1 = new Date(this.props.checkIn);
        const date2 = new Date(this.props.checkOut) ;
        const diffTime = Math.abs(date2 - date1);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
       return diffDays;

      }
    render() {
        
        return ( 
            <div className="hotel_info">
                    <div className="hotel_info-box">
                    <p className="room_badge">Selected hotel</p>
                        <div className="hotel_info-box-img"><img src={require("../../../assets/img/suite-01.jpg")} alt="Hotel"/></div>
                        <div className="hotel_info-box-txt">
                            <h4>{this.state.hotelName}</h4>
                            <p>{this.state.hotelAddress}</p>
                        </div>
                    </div>
                    <div className="hotel_info-box">
                        <p className="room_badge">Selected room</p>
                        <dl>
                            <dt>From: {this.props.checkIn} to {this.props.checkOut}</dt>
                            <dd>{this.state.duration} night</dd>
                            <dt>Room type</dt>
                            <dd>{this.state.roomType}</dd>
                            <dt>Price</dt>
                            <dd>{this.state.TotalPrice}¥</dd>
                        </dl>
                    </div>
                </div>
                
        );
    }
}
export default ReserveRoom;