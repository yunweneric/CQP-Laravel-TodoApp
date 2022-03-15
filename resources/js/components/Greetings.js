import Input from './Input'
import Table from './Table'
import { useEffect } from 'react'
import { useState } from 'react'
const axios = window.axios;
const BaseUrl = 'http://localhost:8000/api';

const Greetings = () => {
    const [todos, settodos] = useState(null)
    useEffect(() => {
        axios.get(`${BaseUrl}/index`).then((response) => {
            settodos(response.data['data'])
        })
    }, [])

    const updateScore = () => {
        if (todos) {
            var done = todos.filter(todos => todos.state == 1);
            return (<p className="fs-1">{(done.length / todos.length).toFixed(2)}</p>)
        }
    }
    return (
        <div className="row  justify-content-center  align-center">
            <div className="col-md-8">
                <div className="card">
                    <div className="card-header">

                        <h5 className=''>Productivity Score</h5>
                        <h5 className=''>{updateScore()}</h5>
                    </div>
                    <div className="card-header">
                        <Input />
                        <Table />

                    </div>
                </div>
            </div>
        </div>)
}

export default Greetings