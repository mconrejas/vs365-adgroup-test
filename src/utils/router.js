import React from "react";
import Storage from "@helpers/Storage";
import { Redirect, Route, useHistory } from "react-router-dom";

function Router({ component: Component, ...rest }) {
  const history = useHistory();

  return (
    <Route
      { ...rest }
      render = { 
        (props) => Storage.get( 'auth' ) ? history.location.pathname == '/login' ? history.goBack() : <Component {...props} /> : <Redirect to='/login' />
      }
    />
  );
}

export default Router;