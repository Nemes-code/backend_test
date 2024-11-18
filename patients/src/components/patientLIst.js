import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import axios from "axios";

function Patients() {
  const [patients, setPatients] = useState([]);
  const [error, setError] = useState(null);

  useEffect(() => {
    // Fetch patient data when the component mounts
    axios
      .get("http://41.188.172.204:30003/patients")
      .then(function (response) {
        const patientsData = response.data.data;
        setPatients(patientsData);
      })
      .catch(function (error) {
        setError(error);
      });
  }, []);

  if (error) {
    return <div>Error: {error.message}</div>;
  } else {
    return (
      <div>
        <h2>Patient List</h2>
        <table className="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Patient Name</th>
              <th>Patient Number</th>
              <th>Guarantor Name</th>
              <th>Date of Birth</th>
              <th>Region</th>
              <th>Ward</th>
            </tr>
          </thead>
          <tbody>
            {patients.map((patient) => (
              <tr key={patient.Registration_ID}>
                <td>
                  <Link to={`/patient/${patient.Registration_ID}`}>
                    {patient.Patient_Name}
                  </Link>
                </td>
                <td>{patient.Registration_ID}</td>{" "}
                {/* Display the patient ID */}
                <td>{patient.Guarantor_Name || "N/A"}</td>
                <td>{patient.Date_Of_Birth}</td>
                <td>{patient.Region}</td>
                <td>{patient.Ward}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    );
  }
}

export default Patients;
