<template>
    
    <!-- Modal -->
   <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background-image: linear-gradient(to right, #5c6bc0, #512da8); color: #fff;">
             <h5 class="modal-title" id="exampleModalLabel">Inscription</h5>
             <button type="button" class="close" @click="closeModal" style="color: #fff;">
               <span aria-hidden="true" style="color: #fff;">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form id="createForm" @submit.prevent="soumettre">
                <input type="hidden" v-model="props.directionId">
                 <div class="form-group">
                    <label for="exampleInputPassword1">Votre numero :</label>
                    <select name="exampleInputPassword1" class="form-control" v-model="numeroEmploye" required>
                      <option value=""></option>
                      <option :key="Fonction.id" v-for="Fonction in editDirection.employe" :value="Fonction.id">{{ Fonction.numero_employer }}</option>
                    </select>
                 </div>
                <div class="form-group">
                  <label>Date candidature :</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                          <input type="date" class="form-control float-right" id="reservation" v-model="daty" required>
                      </div>
                        <!-- /.input group -->
                  </div>
             </form>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-danger" @click="closeModal">Fermer</button>
             <button @click="soumettre" type="submit" class="btn btn-success">Soumettre</button>
           </div>
         </div>
       </div>
     </div>
   </template>
   <script></script>
   <script setup>
   import { ref, reactive, watch, onMounted } from "vue"
   import { Inertia } from "@inertiajs/inertia";
   import { useSwalSuccess, useSwalError } from "../Composables/alert";
   

const daty = ref("");
const staty = ref("En_attente");
const numeroEmploye = ref("");
   const emit = defineEmits(["modalClosed"])
   let editModal = ""
   onMounted(() => {
     editModal =  $("#EditModal")
   })
    const props = defineProps({
       directionId: {
           type: Number,
           required: true
       },
       show: {
           type: Boolean,
           default: false
       }
    })
    const editDirection = reactive({
       employe: "",
   
    })
    const openModal = ()=>{
     editModal.modal("show")
     getDirectionById()
    }
   
    const closeModal = ()=>{
     editModal.modal("hide")
     emit("modalClosed")
     formateError()
    }
    const getDirectionById = ()=>{
       axios.get(route("accueil.poste"))
       .then((response)=>{
           editDirection.employe = response.data.employes
       }).catch((error)=>{
           console.log(error)
       })
    }
    const formateError = ()=>{
         editDirection.ErrorTitre = ""
         editDirection.ErrorCompetence = ""
         editDirection.ErrorDescription = ""
    }
    const soumettre = ()=>{
    const idEmploye = numeroEmploye.value
    const date = daty.value
    const statut = staty.value
    const idOpportunite = props.directionId
    const url = route("accueil.store")
    Inertia.post(url, {idEmploye, date, statut, idOpportunite}, {
      onSuccess: (page) => {
        closeModal()

        //Message de success
        useSwalSuccess(" ajouté avec success !")

      },
      onError: (Errors) => {
 
        

      }
    })

  }
   
    watch(
     () => props.show,
     (newVal, oldVal) =>{
       if(newVal){
         openModal()
       }else{
         closeModal()
       }
     }
    )
   </script>
   <style>
   .modal-footer .btn-success{
    border: none !important;
    box-shadow: none;
    margin-top: 30px;
    background-image: linear-gradient(to right, #5c6bc0, #512da8);
}
.modal-footer .btn-danger{
  border: none !important;
  box-shadow: none;
  margin-top: 30px;
  background-image: linear-gradient(to right, #5c6bc0, rgb(216, 103, 103));
}
  </style>