// Results routes
$router->post('/results', 'ResultController@saveResult');
$router->get('/students/([^/]+)/results', 'ResultController@getStudentResults');
$router->get('/exams/([^/]+)/results', 'ResultController@getExamResults');
$router->get('/results/top', 'ResultController@getTopResults');
$router->get('/updates', 'ResultController@updates');
$router->get('/admin/results', 'ResultController@adminResults');  // Add this line