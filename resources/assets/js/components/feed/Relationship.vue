<template>
	<div>
		<div class="check" v-if="relationShip !==''">
			<a @click="addToFriend(userid)" v-if="relationShip ==='Add To Friend'" class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i> {{ relationShip }}</a>

      <popper v-else-if="relationShip ==='Accept Friend Request'" trigger="hover" :options="{placement: 'auto'}">
        <div class="popper">
          <ul class="relationship-popup">
            <li> <a @click="acceptRequest(userid)">Confirm Request</a></li>
            <li> <a @click="unfriend(userid)">Cancel Request</a></li>
          </ul>
        </div>
        <button slot="reference" class="btn btn-success btn-sm">{{relationShip}}</button>
        
      </popper>

      <popper v-else-if="relationShip ==='Pending Request'" trigger="hover" :options="{placement: 'auto'}">
        <div class="popper">
          <ul class="relationship-popup">
            <li>
              <a @click="unfriend(userid)">Cancel Request</a>
            </li>
          </ul>
        </div>
        <button slot="reference" class="btn btn-success btn-sm">{{relationShip}}</button>
        
      </popper>

      <popper v-else-if="relationShip ==='Friend'" trigger="hover" :options="{placement: 'auto'}">
        <div class="popper">
          <ul class="relationship-popup">
            <li>
              <a @click="unfriend(userid)">Unfriend</a>
            </li>
          </ul>
        </div>
        <button slot="reference" class="btn btn-success btn-sm">{{relationShip}}</button>
        
      </popper>
      

		</div>
	</div>
</template>

<script>
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
                authId:$("#authId").val(),
                relationShip:'',
                //post:'',
                
            }
        },
        http: {
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	       },
        // components:{
        //     Popper
        // },
      		
        props:['userid'],
        
        methods:{
        	unfriend(id){
              axios.post(this.url+'/relationship-remove/'+id).then( response=> {
                  
                  if(response.data == 1){
                    this.relationShip='Add To Friend';
                  }

                  
              });  
            },	
            acceptRequest(id){
              axios.get(this.url+'/accepte-request/'+id).then( response=> {
                  
	              if(response.data == 'yes'){
	                this.relationShip='Friend';
	              }

                  
              });  
            },
            addToFriend(id){
              axios.get(this.url+'/send-request/'+id).then( response=> {
                  
	              if(response.data == 'yes'){
	                this.relationShip='Pending Request';
	              }

                  
              });  
            },	
          
          
        	
        },
        mounted(){
        	
	    	if(this.userid !== 'undefined'){
	    		axios.get(this.url+'/check-relationship/'+this.userid).then( response=> {
	            	//console.log(response.data);
	                this.relationShip = response.data;
	            });
	    	}	
		    
	    },
        
        

    }
</script>