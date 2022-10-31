import React, { useEffect, useState } from "react";
//import data from "./data";
import LazyLoad from "react-lazyload";
import ExportExcel from './Excelexport';
import { Button, Modal,  } from 'react-bootstrap';
import Form from 'react-bootstrap/Form';
const Spinner = () => (

  <div className="post loading">
    <svg
      width="80"
      height="80"
      viewBox="0 0 100 100"
      preserveAspectRatio="xMidYMid"
    >
      <circle
        cx="50"
        cy="50"
        fill="none"
        stroke="#49d1e0"
        strokeWidth="10"
        r="35"
        strokeDasharray="164.93361431346415 56.97787143782138"
        transform="rotate(275.845 50 50)"
      >
        <animateTransform
          attributeName="transform"
          type="rotate"
          calcMode="linear"
          values="0 50 50;360 50 50"
          keyTimes="0;1"
          dur="1s"
          begin="0s"
          repeatCount="indefinite"
        />
      </circle>
    </svg>
  </div>
);

const Post = ({ id, title, gender, location, email, phone,first,last,fetchusers }) => {
  const [show, setShow] = useState(false)
  const[selectedUser, setSelectedUser]=useState({
    first:'',
    last:'',
    title:'',
    gender:'male'
  })

  const handleModal = (user) => {
    setSelectedUser(user)
    console.log('update user',user);
    setShow(true)
  }
  const handleChange=(e)=>{
    setSelectedUser({
      ...selectedUser,
      [e.target.name]: e.target.value
    })
  }
  const handleSubmit=(e)=>{
    e.preventDefault()
    console.log('submit data',selectedUser);
    const requestOptions = {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ title: 'React PUT Request Example' })
  };
  fetch('http://127.0.0.1:8000/api/v1/update', requestOptions)
      .then(response => response.json())
      .then(data =>{
        console.log('ssubmit res',data)
if(data.status=200){
  setShow(false)
  setSelectedUser({
    first:'',
    last:'',
    title:'',
    gender:'male'
  })
  fetchusers()
}
      } );


    
  }
  return (
  <div className="post">
        <Modal  show={show} onHide={() => setShow(false)}>
        <Modal.Header closeButton>This is a Modal Heading</Modal.Header>
        <Modal.Body>
      
    <Form onSubmit={handleSubmit}>
      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>First name</Form.Label>
        <Form.Control type="text" name='first' value={selectedUser.first} placeholder="Enter firstname" onChange={handleChange} />
      </Form.Group>
      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>Last Name</Form.Label>
        <Form.Control type="text" name='last' value={selectedUser.last} placeholder="Enter lastname"  onChange={handleChange}/>
      </Form.Group>
      <Form.Group className="mb-3" controlId="formBasicEmail">
        <Form.Label>Title</Form.Label>
        <Form.Control type="text" name='title' value={selectedUser.title} placeholder="Enter title"  onChange={handleChange} />
      </Form.Group>
      <Form.Group className="mb-3" controlId="formBasicEmail">
      <div key={`inline-${'redio'}`} className="mb-3">
      <Form.Check inline label="Male" name="gender"  checked={selectedUser.gender === "male"}  onChange={handleChange} value='male' type={'radio'} id={`inline-${'radio'}-1`} />
      <Form.Check inline label="Female" name="gender"  checked={selectedUser.gender === "female"}  onChange={handleChange} value='female' type={'radio'} id={`inline-${'radio'}-2`} />
     
    </div>
      </Form.Group>
     
      <Button variant="primary" type="submit">
        Submit
      </Button>
    </Form>


       
        </Modal.Body>
       
      </Modal>
 
    <LazyLoad
      once={true}
      placeholder={<img src={`https://picsum.photos/id/${id}/5/5`} alt="..." />}
    >
      <div className="post-img">
        <img src={`https://picsum.photos/id/${id}/1000/1000`} alt="..." />
      </div>
    </LazyLoad>
    <div className="post-body pt-2">
    <span className="modalClass ">
          <Button classname='mt-4' onClick={() => handleModal({ id, title, gender, location, email, phone,first,last })}> Edit </Button>
        </span>
        <p></p>
        <span>{title}</span> <span>{first}</span>{' '}<span>{last}</span>
      <p>{gender}</p>
      <p>{location}</p>
      <p>{email}</p>
      <p>{phone}</p>
    
    </div>
  </div>
)}

const App = () => {
  const[data,setData]=useState([])
useEffect(()=>{
  fetchUsers()
},[])
const fetchUsers=()=>{
  fetch('http://127.0.0.1:8000/api/v1/display?offset=15&limit=5').then((res)=>res.json()).then((result)=>{
  if(result.users){
    console.log('result',result);
    setData(result.users)
  }
})
}
const exportCsv=()=>{
  fetch('http://127.0.0.1:8000/api/v1/csvExport').then((res)=>res.json()).then((result)=>{
  if(result.users){
    console.log('export file res',result);
  }
})
}

  return (
    <div className="App">
       
      <h2>LazyLoad Demo</h2>
      <ExportExcel excelData={data} fileName={"Excel Export"} />

     
      <div className="post-container">
        

        {data.map(post => (
          <LazyLoad
            key={post.id}
            height={100}
            offset={[-100, 100]}
            placeholder={<Spinner />}
          >

            <Post key={post.id} {...post} fetchusers={fetchUsers} />

          </LazyLoad>
        ))}
      </div>
    </div>
  );
}

export default App;
