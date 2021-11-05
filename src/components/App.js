import React from 'react';
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Router from '@utils/router';
import Login from '@pages/Login'
import Dashboard from '@pages/Dashboard'
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.min.css';

function App() {
  return (
    <div>
      <BrowserRouter>
         <div className="App">
            <Switch>
              <Route exact path='/login' component={Login} />
              <Router exact path='/' component={Dashboard} />
            </Switch>
         </div>
      </BrowserRouter>
      <ToastContainer
        position="top-right"
        autoClose={5000}
        hideProgressBar={false}
        newestOnTop={false}
        closeOnClick
        rtl={false}
        pauseOnFocusLoss
        draggable
        pauseOnHover
      />
    </div>
  );
}

export default App;