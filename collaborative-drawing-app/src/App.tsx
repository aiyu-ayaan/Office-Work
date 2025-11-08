import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import NameEntry from './pages/NameEntry';
import DrawingRoom from './pages/DrawingRoom';
import './App.css';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<NameEntry />} />
        <Route path="/room/:roomId" element={<DrawingRoom />} />
      </Routes>
    </Router>
  );
}

export default App;
