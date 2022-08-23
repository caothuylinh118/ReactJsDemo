import React, { Component } from 'react';
import { Link,useParams } from 'react-router-dom';

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


function withParams(Component) {
    return props => <Component {...props} params={useParams()} />;
}

class List extends Component {
    constructor(props) {
        super(props);
        this.state = {
            modalIsOpen: false,
            dateIn: new Date(),
            dateOut: new Date(),
            valueCity: '',
            selectedCity: this.props.params.city,
            selectedFrom: this.props.params.from,
            selectedTo: this.props.params.to,
            list_hotel: [],
            recommended_hotel: [],
            valueCityAfterChange: '',
            dateInFormated: '',
            dateOutFormated: '',
            IsLogin: false,
            
            
        }
        this.formatDate = this.formatDate.bind(this);
        this.formatDateMatch = this.formatDateMatch.bind(this);
        this.onChangeIn = this.onChangeIn.bind(this);
        this.onChangeOut = this.onChangeOut.bind(this);
        this.createListImage = this.createListImage.bind(this);
        this.HanldeSelectCity = this.HanldeSelectCity.bind(this);
        this.handleSearch = this.handleSearch.bind(this);
        
    } 

    componentDidMount() {
        const { city } = this.props.params;
        const { from } = this.props.params;
        const { to } = this.props.params;
        this.setState({
            valueCityAfterChange: city,
        })
        fetch(Common.api + Common.list_hotel + '?city=' + city + '&from_date=' + from + '&to_date=' + to)
        .then(res => res.json())
        .then((data) => {
        console.log(data);
        this.setState({
            list_hotel: data.data

        })
        })
        .catch(console.log)

        fetch(Common.api + Common.recommended_hotel + '?city=' + city + '&limit=3')
        .then(res => res.json())
        .then((data) => {
          console.log(data);
          this.setState({
            recommended_hotel: data.data,
            dateInFormated: from,
            dateOutFormated: to
          })
        })
        .catch(console.log)
      
    
          this.setState({
            dateIn: new Date(from),
            dateOut: new Date(to),
            valueCity: city,
            dateInFormated: from,
            dateOutFormated: to
    
          })

            var user = sessionStorage.getItem("UserLogin")
            var userObject = JSON.parse(user)
            console.log(userObject !== undefined );
            console.log("user object: " + userObject)
            if (userObject !== undefined && userObject !== null) {
                this.setState({
                    email: userObject.user_email,
                    name: userObject.user_name,
                    IsLogin: true
                })
            }
      }

    toggleModal = () => {
    this.setState(state => ({ modalIsOpen: !state.modalIsOpen }));
    }
    
    onChangeIn(dateIn) {
        this.setState({ 
            dateIn: dateIn,
            dateInFormated: this.formatDateMatch(dateIn)
        })
        console.log("Format date: " + this.state.dateInFormated)
    }

    onChangeOut(dateOut) {
        this.setState({ 
            dateOut: dateOut,
            dateOutFormated: this.formatDateMatch(dateOut)
        })

    }


    createListImage(listImage) {
        var images = [];
        for (var i=0; i < listImage.length; i++) {
            var image = {src: listImage[i].url};
            images.push(image)
        }
        return images;
    }

    formatDate(dateInput) {
        var date = new Date(dateInput);
        var year = date.getFullYear();

        var month = (1 + date.getMonth()).toString();
        month = month.length > 1 ? month : '0' + month;

        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
    
        console.log("FORMAT DATE : " + month + '/' + day + '/' + year);
        

     return day + '/' + month + '/' + year;
    }
    
    HanldeSelectCity(event) {
        this.setState({valueCity: event.target.value})
    }

    handleSearch() {
        fetch(Common.api + Common.list_hotel + '?city=' + this.state.valueCity + '&from_date=' + this.state.dateIn + '&to_date=' + this.state.dateOut)
            .then(res => res.json())
            .then((data) => {
                this.setState({
                    list_hotel: data.data,
                    valueCityAfterChange: this.state.valueCity
                  })
            })
            .catch(console.log)
    }

    formatDateMatch(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
    
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
    
        return [year, month, day].join('-');
    }

  render() {
    const { modalIsOpen } = this.state;
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
                            <button type="button" className="btn" onClick = { this.handleSearch }>Search Hotel</button>
                        </fieldset>
                    </form>    
            
                </div>
            </section>
            <section className="navigation">
                <div className="container">
                    <ul>
                        <li><Link to={'/home' }>Home</Link><span>></span></li>
                        <li>Hotels in {this.state.valueCityAfterChange} <span>({this.state.list_hotel.length})</span></li>
                    </ul>
                </div>
            </section>
            <div className="container">
            
            <section className="list">
                <div className="list_recommend">
                    <h3>Recommend hotel in {this.state.valueCityAfterChange}</h3>
                    {this.state.recommended_hotel.map((item, index) =>
                    <div className="list_recommend_box" key={index}>
                        <div className="list_recommend_box_img"><img src={item.hotel_image} alt=""></img></div>
                        <div className="list_recommend_box_txt">
                            <p><Link to={'/' + this.state.valueCityAfterChange + '/room/'+ item.hotel_id +'/'+ this.state.dateInFormated + '/' + this.state.dateOutFormated }>{(item.hotel_name ) || ''}</Link></p>
                            <p>{(item.hotel_address ) || ''}</p>
                            <p>Price From: <span>{(item.price_from ) || ''}¥</span></p>
                        </div>
                    </div>
                     )}
                    
                </div>
                <div className="list_hotel">
                    <h3>Hotel in {this.state.valueCityAfterChange}</h3>
                    {this.state.list_hotel.map((item, index) =>
                    <div className="list_hotel_box" key={index}>
                        <div className="list_hotel_box_img">
                        <Carousel views={(this.createListImage(item.images) ) || ''} />
                        <ModalGateway>
                            {modalIsOpen ? (
                            <Modal onClose={this.toggleModal}>
                                <Carousel views={(this.createListImage(item.images) ) || ''}/>
                            </Modal>
                            ) : null}
                        </ModalGateway>
                        </div>
                        <div className="list_hotel_box_txt">
                            <p className="hotel-name"><Link to={'/' + this.state.valueCityAfterChange + '/room/'+ item.hotel_id +'/'+ this.state.dateInFormated + '/' + this.state.dateOutFormated }>{(item.hotel_name ) || ''}</Link></p>
                            <p className="hotel-add">{(item.hotel_address ) || ''}</p>
                            <p className="hotel-price">Price From: <span>{(item.price_from ) || ''}¥</span></p>
                        </div>
                    </div>
                        )}
                    
                </div>
            </section>
      </div>
   
       </div>
       
    )}
}

export default withParams(List);
