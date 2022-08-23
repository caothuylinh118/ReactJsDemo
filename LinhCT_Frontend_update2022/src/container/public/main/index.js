import React from 'react'
import { BrowserRouter, Routes, Route } from 'react-router-dom';
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
          <Routes>
                  <Route exact path="/" element={<Home/>}/>
                  <Route  path="/list/finished" element={<Finished/>}/>
                  <Route  path="/:hotelId/:roomId/:from/:to/reserve/info" element={<Reserve/>}/>
                  <Route  path="/:city/room/:id/:from/:to" element={<HotelDetail/>}/>
                  <Route  path="/hotel/list/:city/:from/:to" element={<List/>}/>
                  <Route  path="/home" element={<Home/>}/>
                  <Route  path="/login" element={<Login/>}/>
                  <Route  path="/register" element={<Register/>}/>
                  <Route  path="/hotellist/" element={<HotelList/>}/>
                
          </Routes>
            
        </main>
    );
  }
}
export default Main
