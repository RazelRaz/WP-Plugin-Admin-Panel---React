// import { Button } from '@wordpress/components';
// import apiFetch from '@wordpress/api-fetch';
import { useEffect, useState } from 'react';

function PostView() {

  const [postdata, setPostdata] = useState({});

  const onSubmit = (event) => {
    event.preventDefault();
    // console.log(event);

    let formData = new FormData(event.target);
    formData.append('action', 'rz_settings_post_view');

    // console.log(formData.values());
    // console.log(formData.entries());
    // // Display the key/value pairs
    // for (const pair of formData.entries()) {
    //   console.log(pair[0], pair[1]);
    // }

    fetch(
      rzSettings.ajaxUrl,
      {
        method: 'POST',
        body: formData
      }
    ).then((response) => {
      return response.json();
      
    }).then((response) => {
      console.log(response);
      
    });
    
  };


  // Get settings data when component load
  useEffect(() => {
    // console.log('Its Working');

    fetch(
      rzSettings.ajaxUrl + "?action=rz_settings_get_post_view"

    ).then((response) => {
      return response.json();
      
    }).then((response) => {
      console.log(response);

      if ( response.success ) {
        setPostdata(response.data);
      }
      
    });
    
  }, []);

  const onCheckboxChange = (event) => {
    // console.dir(event.target);
    setPostdata({ ...postdata, 
      [event.target.name]: event.target.checked
    });
  }

  return (
    <div>
      <form onSubmit={onSubmit}>
        <table className="form-table">
          <tbody>
            <tr>
              <th>Heading</th>
              <td><input type="text" className="regular-text" name="heading" defaultValue={ postdata.heading ? postdata.heading : '' } /></td>
            </tr>
            <tr>
              <th>Show/Hide</th>
              <td>
                <label>
                  <input type="checkbox" className="regular-text" name="show" onChange={onCheckboxChange} checked={ postdata.show ? true : false } />
                  Show
                </label>
              </td>
            </tr>
            <tr>
              <th></th>
              <td>
              <button className='components-button is-secondary'>Submit</button>
              </td>
            </tr>
            
          </tbody>
        </table>
      </form>
    </div>
  );
}

export default PostView;