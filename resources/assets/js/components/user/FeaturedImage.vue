<template>
	<div>
		<div class="modal-mask" @click="close" v-show="show" >
            <div class="modal-container" @click.stop>
                
                <div class="modal-body modal-body-image no_padding">
                	<a class="modal-default-button" @click="savePost()">
                        <i class="fa fa-times" style="font-size: 25px;"></i>
                    </a>
                    <div class="row no_padding" style="height:100%;">
                        <div class="col-sm-12 featured_modal no_padding" style="height:100%;">
                            <div class="image_section">
                                
                                <div class="pre" @click="prePost(pre)"><i class="fa fa-angle-left"></i></div>
                                <img v-if="imageInfo" :src="url+'/images/post/photo/'+imageInfo" class="img-responsive" alt="">
                                <div class="next" @click="nextPost(next)"><i class="fa fa-angle-right"></i></div>   
                                
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
	</div>
</template>

<script>

	export default {

		props: ['show','imageInfo','next','pre', 'featuredImages'],
        data() {

            return {
                url:$("#base_url").val(),
                showModal: false,
                pre:'',
                next:'',
                imageInfo:{},

            }
        },
        
        methods: {
        	
		    close: function () {
		      this.$emit('close');
		    },
		    savePost: function () {
		      // Some save logic goes here...
		      
		      this.close();
		    },

		    nextPost(e){
                
		    	let postImages = this.featuredImages;
		    	//console.log(this.featuredImages);
		    	if(e >= this.featuredImages.length || e==="-1"){
		    		this.imageInfo = postImages[0].image;
		    		
		    		this.pre = -1;
                	this.next= 1;
		    	}else{
		    		this.imageInfo = postImages[e].image;
		    			
		    		this.pre=e-1;
                	this.next=e+1;
		    	}
                //console.log(postImages);
		    },
		    prePost(e){
                //console.log(e);
		    	let postImages = this.featuredImages;
		    	
		    	if(e == "-1"){
		    		
                    this.imageInfo = postImages[postImages.length-1].image;
		    		this.pre = postImages.length-2;
                	this.next= postImages.length;
		    	}else{
		    		
		    		
                    this.imageInfo = postImages[e].image;	
		    		this.pre=e-1;
                	this.next=e+1;
		    	}
		    },

            
		},
		mounted: function () {

		    document.addEventListener("keydown", (e) => {
		      if (this.show && e.keyCode == 27) {
		        this.close();
		      }
		    });
            
            
		}

    }
</script>
<style>
	.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    transition: opacity .3s ease;
}
.cotent_section{width:100%; height:100%; padding-top: 20px;}
.modal-container { width: 90%; overflow: hidden; margin: 40px auto; padding: 0px; background-color: #fff; border-radius: 2px; -webkit-box-shadow: 0 2px 8px rgba(0, 0, 0, .33); box-shadow: 0 2px 8px rgba(0, 0, 0, .33); -webkit-transition: all .3s ease; transition: all .3s ease; font-family: Helvetica, Arial, sans-serif; padding-bottom: 0px; height: 90%;
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body-image { width: 100%; height: 100%; }

.text-right {
    text-align: right;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
.modal-default-button{position: fixed; top: 5px; right: 48px; border: 2px solid #0e1626; color: red; border-radius: 50px; padding: 5px;}

.featured_modal .image_section{width: auto; height: 100%; position: relative;background: #000; padding-top: 0px;}
.featured_modal .image_section img{object-fit: contain;
    width: 100%;
    height: 100%;}


.right_content{width: 100%; padding: 0 15px; height: 95%; overflow-y:scroll; }

.next{position: absolute; right: 27px; top: 44%; color: none; background: none; padding: 0 9px; font-size: 42px;}
.next:hover{cursor:pointer; position: absolute; right: 27px; top: 44%; color: #fff; background: #ccc; padding: 0 9px; font-size: 42px;}
.pre{position: absolute; left: 27px; top: 44%; color: none; background: none; padding: 0 9px; font-size: 42px;}
.pre:hover{cursor:pointer; position: absolute; left: 27px; top: 44%; color: #fff; background: #ccc; padding: 0 9px; font-size: 42px;}
</style>