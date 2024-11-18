import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Patients from "./components/patients";
import Header from "./layout/Header";
import PatientTable from "./components/patientLIst";
import PatientDetails from "./components/patientDetails";

function App() {
  return (
    <Router>
      <Header />
      <Routes>
        <Route path="/" element={<Patients />} />
        <Route path="/pat" element={<PatientTable />} />
        <Route path="/patient/:id" element={<PatientDetails />} />
      </Routes>
    </Router>
  );
}

export default App;
