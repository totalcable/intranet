<?php
class Mylib {
	public function get_discount($item){
		$this->loadModel('ServiceCharge');
		$this->loadModel('ZeroServiceCharge');
		$service_crages=$this->ServiceCharge->find('all');
		$zero_service_charge=$this->ZeroServiceCharge->find('all');
		$zero_service_charge=$zero_service_charge[0]['ZeroServiceCharge']['items'];
		if( $item>=$zero_service_charge){
			return 100;
		}
		foreach ($service_crages as $service_crage) {
			pr($service_crage);
			exit;
   //if($service_crage)
		}

		
	}
}
?>