import React, { useState, useEffect } from "react";
import axios from "axios";

function PatientDetails({ registrationId }) {
  const [patientDetails, setPatientDetails] = useState(null);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(
          `http://41.188.172.204:30003/patients?Registration_ID=${registrationId}`
        );
        setPatientDetails(response.data.data[0]);
      } catch (error) {
        setError(error);
      }
    };
    fetchData();
  }, [registrationId]);

  if (error) {
    return <div>Error: {error.message}</div>;
  } else if (!patientDetails) {
    return <div>Loading...</div>; // Show loading message while fetching data
  } else {
    return (
      <div>
        <h2>Patient Details</h2>
        <div>
          <p>Patient Name: {patientDetails.Patient_Name}</p>
          <p>Registration ID: {patientDetails.Registration_ID}</p>
          <p>Title: {patientDetails.Title}</p>
          <p>Date of Birth: {patientDetails.Date_Of_Birth}</p>
          <p>Gender: {patientDetails.Gender}</p>
          <p>Country: {patientDetails.Country}</p>
          <p>Region: {patientDetails.Region}</p>
          <p>District: {patientDetails.District}</p>
          <p>Ward: {patientDetails.Ward}</p>
          <p>Sponsor ID: {patientDetails.Sponsor_ID}</p>
          <p>Member Number: {patientDetails.Member_Number}</p>
          <p>Phone Number: {patientDetails.Phone_Number}</p>
          <p>Email Address: {patientDetails.Email_Address}</p>
          <p>
            Registration Date and Time:{" "}
            {patientDetails.Registration_Date_And_Time}
          </p>
          {/* Add more patient details as needed */}
        </div>
      </div>
    );
  }
}

export default PatientDetails;
