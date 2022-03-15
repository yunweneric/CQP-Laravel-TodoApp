import React from 'react'
import ReactDOM from 'react-dom';
import Greetings from '../components/Greetings'
import Input from '../components/Input';
import { useEffect } from 'react'
import api from '../components/api';

const App = () => {

    return (
        <div className=" container">
            <Greetings />
        </div>)
}

export default App

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
