import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import Carousel, { Modal, ModalGateway } from 'react-images';



class ListBlock extends Component {
    constructor(props) {
        super(props);
        this.state = {
            modalIsOpen: false,
            IsSelectedRoom: 0,
            list_room: [],
            images: [],
            item: this.props.item,
            roomCount: '0',
        }

        this.props = props;

        this.createListImage = this.createListImage.bind(this);
        this.HanldeRoomCount = this.HanldeRoomCount.bind(this);

    }
    
    // componentDidMount() {
    //     console.log("Images of Rooms:");
    //     console.log(this.state.item.images);
        
    // }

      HanldeRoomCount(event) {
        this.setState({
            roomCount: event.target.value,

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
    render() {
        const { modalIsOpen } = this.state;
        const { IsSelectedRoom } = this.state;

        return ( 
            <div>
                <div className="list_room_box">
                    <div className="room-type">
                        <Carousel views={(this.createListImage(this.state.item.images) ) || ''} />
                        <ModalGateway>
                            {modalIsOpen ? (
                            <Modal onClose={this.toggleModal}>
                                <Carousel views={(this.createListImage(this.state.item.images) ) || ''}/>
                            </Modal>
                            ) : null}
                        </ModalGateway>
                    </div>
                    <div className="room-name">
                        <h4>{(this.state.item.room_name ) || ''}</h4>
                        <p><i class="fas fa-check"></i>{(this.state.item.room_type ) || ''}</p>
                        <p><i class="fas fa-check"></i>{(this.state.item.room_left ) || ''} room left</p>
                    </div>
                    <div className="room-max"><i class="fas fa-male"></i> <i class="fas fa-male"></i></div>
                    <div className="room-price">{(this.state.item.room_price ) || ''}¥</div>
                    <div className="room-count">
                        <fieldset>
                            <select required name='from' onChange={this.HanldeRoomCount} value={this.state.roomCount}>
                                <option value="">Room</option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                            </select>
                        </fieldset>
                    </div>
                    <div className="room-btn">
                        <fieldset>
                            {this.state.roomCount > 0 ? 
                                <button type="submit" id="reserve" className="btn"><Link to={'/'+ this.props.selectedHotelId + '/' + this.state.item.room_id + '/' + this.props.checkIn + '/' + this.props.checkOut + '/reserve/info' }>Reserve</Link></button>
                         : 
                         <button type="submit" id="reserve" className="btn" disabled><Link to={'/'+ this.props.selectedHotelId + '/' + this.state.item.room_id + '/' + this.props.checkIn + '/' + this.props.checkOut + '/reserve/info' }>Reserve</Link></button>}
                            
                        </fieldset>
                    </div>

                </div>
            </div>        
        );
    }
}
export default ListBlock;