import React, { Component } from 'react';
import Common from '../../../common/common';
import $ from 'jquery';

class ConfirmCustomer extends Component {
    constructor(props) {
        super(props);
        this.state = {
            room_count: '1'
        }

        this.props = props;
        this.bookingConfirm = this.bookingConfirm.bind(this);
    }
     
    bookingConfirm = event =>{
        event.preventDefault();
        const url = Common.api + '/book'
        const data = { 'user_email':this.props.email, 'room_id': this.props.roomId, 'from_date': this.props.from, 'to_date':this.props.to, 'room_count':this.state.room_count}
        console.log(data)
        var props = this.props;
    
        $.ajax({
          method: "POST",
          url: url,
          data: data
        })
        .done(function( result ) {
          console.log(result);
          result = JSON.parse(result);
          
          if (result.result_code == "success") {
            props.finished();

          }
        });
        
        
      }
    render() {
        
        return ( 
            <div className="customer_info">
                <h3>Confirm your information </h3>

                    <form id="information" action="#" method="post">
                        <p>Name: {this.props.name}</p>
                        <p>Email: {this.props.email}</p>
                        <p>Phone: {this.props.phone}</p>
                        <fieldset>
                            <button type="submit" id="form-submit" class="btn" onClick = {this.bookingConfirm}>Confirm</button>
                        </fieldset>
                    </form>
                  
                </div>
                
        );
    }
}
export default ConfirmCustomer;