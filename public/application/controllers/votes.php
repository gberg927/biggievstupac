<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Votes extends CI_Controller {
	public function index()
	{
		//do nothing
	}

	public function getCounts()
	{
		$this->db->from('votes');
		$this->db->join('voteType', 'votes.voteType = voteType.id');
		$this->db->where('voteType.title', 'Biggie'); 
		$biggie = $this->db->count_all_results();

		$this->db->from('votes');
		$this->db->join('voteType', 'votes.voteType = voteType.id');
		$this->db->where('voteType.title', 'Tupac'); 
		$tupac = $this->db->count_all_results();

		$voteCounts = array('biggie' => $biggie, 'tupac' => $tupac);
    	$votes = array('votes' => $voteCounts);

    	header('Content-Type: application/json');
    	echo json_encode($votes);
	}

	public function vote()
	{
		$title = $this->input->post('title');
		$ip = $this->input->ip_address();
		$sql = 'INSERT INTO votes (voteType) SELECT id FROM voteType WHERE title = "' . $title . '"';
		$this->db->query($sql);

	}
}