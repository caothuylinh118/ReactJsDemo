import React from 'react'
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import Home from '../../public/home/';
import List from '../../public/list/';
import Login from '../../public/login/';
import Reserve from '../../public/list/reserve';
import Register from '../../public/register/';
import HotelDetail from '../../public/list/detail';
import Finished from '../../public/list/finished';
import HotelList from '../../public/booked/hotel_list';


//https://gorest.co.in/
//http://dummy.restapiexample.com/

class Main extends React.Component {
  render() {
      return (
        <main className="main">
          <Switch>
                  <Route exact path="/" component={Home}/>
                  <Route  path="/list/finished" component={Finished}/>
                  <Route  path="/:hotelId/:roomId/:from/:to/reserve/info" component={Reserve}/>
                  <Route  path="/:city/room/:id/:from/:to" component={HotelDetail}/>
                  <Route  path="/hotel/list/:city/:from/:to" component={List}/>
                  <Route  path="/home" component={Home}/>
                  <Route  path="/login" component={Login}/>
                  <Route  path="/register" component={Register}/>
                  <Route  path="/hotellist/" component={HotelList}/>
                
          </Switch>
            
        </main>
    );
  }
}
export default Main
