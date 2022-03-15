import React from 'react'
import { useState } from 'react'

const axios = window.axios;
const BaseUrl = 'http://localhost:8000/api';
const Input = () => {

    const headers = {
        'accept': 'application/json',
        'Content-Type': 'application/json',
    }

    const [title, settitle] = useState('')
    const [activity, setactivity] = useState('')
    const [dateline, setdateline] = useState('')

    const addTodo = (e) => {
        e.preventDefault()

        var todo = {
            "name": title,
            "activity": activity,
            "state": "0",
            "dateline": dateline,
        }


        axios.post('http://localhost:8000/api/store', (todo))
            .then(
                window.location.reload(),
                // response => alert(JSON.stringify(response.data))

            )
            .catch(error => {
                console.log("ERROR:: ", error.response.data);
                alert("There was an error adding the data");
            });


    }
    return (
        <div className="">
            <form>
                <div className="mt-5">
                    <div className="d-flex justify-content-between">
                        <div className="w-75">
                            <input type="text" required id="inputPassword5" placeholder="What is the name of your todo?"
                                onChange={e => {
                                    settitle(e.target.value)
                                }} className="form-control" aria-describedby="passwordHelpBlock" />
                            <div id="passwordHelpBlock" className="form-text">
                            </div>
                        </div>
                        <div className="w-25 ps-5">
                            <input required
                                onChange={(e) => {
                                    setdateline(e.target.value)
                                }}
                                type="date" id="inputPassword5" placeholder="When do you want to do this?" className="form-control" aria-describedby="passwordHelpBlock" />
                            <div id="passwordHelpBlock" className="form-text">
                            </div>
                        </div>
                    </div>
                    <div className="form-group">
                        <textarea className="form-control" onChange={e => setactivity(e.target.value)} id="context" placeholder="What do you want to do?" rows="2"></textarea>
                    </div>
                    <div className="d-flex justify-content-end">
                        <button type="button" onClick={addTodo} className=" mt-2 btn btn-success">Add Todo</button>

                    </div>
                </div>
            </form>

        </div >
    )
}

export default Input