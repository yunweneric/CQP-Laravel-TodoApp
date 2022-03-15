import React, { useEffect } from 'react'
import { useState } from 'react'
const axios = window.axios;
const BaseUrl = 'http://localhost:8000/api';

const Table = () => {

    const [todos, settodos] = useState(null)
    const [deleteTodo, setDeleteTodo] = useState(null)

    useEffect(() => {
        axios.get(`${BaseUrl}/index`).then((response) => {
            settodos(response.data['data'])
        })
    }, [todos])

    const setDelete = (e, id) => {
        e.preventDefault();
        axios.post(`http://localhost:8000/api/delete/${id}`)
            .then(
                window.location.reload(),
            )
            .catch(error => {
                console.log("ERROR:: ", error.response.data);
                alert("There was an error adding the data");
            });

    }
    const setDone = (e, id) => {
        axios.post(`http://localhost:8000/api/done/${id}`)
            .then(
                window.location.reload(),
            )
            .catch(error => {
                console.log("ERROR:: ", error.response.data);
                alert("There was an error adding the data");
            });

    }


    const renderTodos = () => {
        if (!todos) {
            return (
                <tr>No Todos Found!</tr>
            )
        }
        else {
            return todos.map((todo, index) =>
            (<tr className="mt-5" style={{ marginTop: "10px" }} key={index} >
                <th scope="row">{index + 1}</th>
                <td>{todo.name}</td>
                <td>{Date(todo.dateline)}</td>
                <td className={todo.state == 1 ? "py-2 rounded bg-success text-white " : "rounded bg-warning"}>{todo.state == 1 ? "Done" : "Not Done"}</td>
                <td>
                    <div className="d-flex">
                        <button onClick={e => setDelete(e, todo.id)} className="DeleteBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" onClick={e => setDelete(e)} className="icon" fill="none" viewBox="0 0 24 24" stroke="red" strokeWidth="1">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                        <div className="w-10"></div>
                        <button onClick={e => setDone(e, todo.id)} className="DeleteBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" className="icon h-2 w-2" fill="none" viewBox="0 0 24 24" stroke="green" strokeWidth="1">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>

                        <div className="w-10"></div>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" className="icon h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr >)
            )

        }
    }
    return (
        <div>
            <div>
                <table className="mt-5 table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Todo Name</th>
                            <th scope="col">Due date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {renderTodos()}
                    </tbody>
                </table>

            </div>


        </div>
    )
}

export default Table