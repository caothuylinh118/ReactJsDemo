import React from 'react';
import {  BrowserRouter,Route, Switch} from 'react-router-dom';
import '../src/assets/css/index.css';
import Header from './container/public/header';
import Main from './container/public/main';
import Footer from './container/public/footer';

function App() {
  return (
    <div className="App">

      <BrowserRouter>
        
        <Main/>
        <Footer/>
      </BrowserRouter>    
        </div>
  );
}

export default App;
