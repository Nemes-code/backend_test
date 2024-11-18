import React, { useState } from "react";
import { Link } from "react-router-dom";

function Navigation() {
  return (
    <div>
      <nav className="navbar navbar-light bg-secondary">
        <div className="btn btn-secondary">
          <Link to="/pat" className="btn btn-secondary">
            Patients list
          </Link>
          <Link to="/" className="btn btn-secondary">
            Home
          </Link>
        </div>
      </nav>
    </div>
  );
}

export default Navigation;
