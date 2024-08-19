<template>
    <div class="detail" style="margin-top: 70px;margin-left: 120px;">
      <section class="content">
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-1">
    
          </div>
          <div class="col-md-10">
        
            <div class="card card-primary">
            <div class="card-header" style="background: #2a2185;">
            <h3 class="card-title">Ajout d'un employé</h3>
            </div>
                    <form @submit.prevent="soumettre">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleInputEmail1">Numero_employé :</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.numero_employer" :class="{'is-invalid': form.errors.numero_employer}" required>
                                    <span v-if="form.errors.numero_employer" class="invalid-feedback error">{{ form.errors.numero_employer }}</span>
                                    </div>
                                    <div class="col-6">
                                    <label for="exampleInputPassword1">Nom :</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" v-model="form.nom" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="exampleInputPassword1">Prénom :</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1" v-model="form.prenom" required>
                                    </div>
                                    <div class="col-6">
                                      <label>Date de naissance :</label>
                                          <div class="input-group">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                              </span>
                                            </div>
                                              <input type="date" class="form-control float-right" id="reservation" v-model="form.date_naissance" required>
                                          </div>
                                            <!-- /.input group -->
                                      </div>
                                      <div class="col-6">
                                        <label for="exampleInputPassword1">Sexe :</label>
                                        <select name="exampleInputPassword1" class="form-control" v-model="form.sexe" required>
                                          <option value="M">Masculin</option>
                                          <option value="F">Feminin</option>
                                        </select>
                                        </div>
                                          <div class="col-6">
                                            <label for="exampleInputPassword1">Adresse :</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" v-model="form.adresse" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="exampleInputPassword1">E-mail :</label>
                                            <input type="email" class="form-control" id="exampleInputPassword1" v-model="form.email" required>
                                            </div>
                                        <div class="col-6">
                                            <label for="exampleInputPassword1">Téléphone :</label>
                                            <input type="text" class="form-control" id="exampleInputPassword1" v-model="form.telephone" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="exampleInputPassword1">Grade :</label>
                                            <select name="exampleInputPassword1" class="form-control" v-model="form.grade_id" required>
                                              <option value=""></option>
                                              <option :key="Grade.id" v-for="Grade in props.Grades" :value="Grade.id">{{ Grade.numero_grade }}</option>
                                            </select>
                                            </div>
                                            <div class="col-6">
                                                <label for="exampleInputPassword1">Corps :</label>
                                                <select name="exampleInputPassword1" class="form-control" v-model="form.corps_id" required>
                                                  <option value=""></option>
                                                  <option :key="Corp.id" v-for="Corp in props.Corps" :value="Corp.id">{{ Corp.numero_corps }}</option>
                                                </select>
                                                </div>
                                        <div class="col-6">
                                            <label>Date d'embauche :</label>
                                                <div class="input-group">
                                                  <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                      <i class="far fa-calendar-alt"></i>
                                                    </span>
                                                  </div>
                                                  <input type="date" class="form-control float-right" id="reservation" v-model="form.date_embauche" required>
                                                </div>
                                                <!-- /.input group -->
                                              </div>
                                    <div class="col-6">
                                      <label for="exampleInputPassword1">Fonction :</label>
                                      <select name="exampleInputPassword1" class="form-control" v-model="form.fonction_id" required>
                                        <option value=""></option>
                                        <option :key="Fonction.id" v-for="Fonction in props.Fonctions" :value="Fonction.id">{{ Fonction.numero_fonction }}</option>
                                      </select>
                                      </div>
                                      <div class="d-flex justify-content-between col-12 mt-2">
                                        <div class="col-6">
                                          <label for="exampleInputFile">Photo :</label>
                                            <div class="custom-file">
                                              <input :key="inpuKey" type="file" class="custom-file-input" id="exampleInputFile" @input="previewtImage($event)">
                                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                            
                                        </div>
                                        <div class="col-2" style="margin-left: 80px; margin-top: 10px;">
                                            <img src="" id="image-preview" style="width:75px;height:75px;border-radius: 25px;display:none;">
                                        </div> 
                                        </div>
                            </div>
                        </div>
                                    
                        <div class="card-footer">
                          <Link :href="route('employer')" class="btn btn-danger mr-2">Retour</Link>
                        <button type="submit" class="btn btn-success">Soumettre</button>
                        </div>
                        </form>


     
            </div>
          </div>
        <div class="col-md-1">
        
      </div>
    </div>
    </div>
    </section>
    </div>
    
    </template>
    
    <script setup>
       import { useForm } from '@inertiajs/inertia-vue3';
       import { useSwalSuccess, useSwalError } from '../../Composables/alert';
       import { ref } from 'vue';
    
       const inputKey = ref(0);
       const props = defineProps({
        Grades: Array,
        Corps: Array,
        Fonctions: Array,
        Employers: Object
       })
       const form = useForm({
        numero_employer: "",
        nom: "",
        prenom: "",
        adresse: "",
        date_naissance: "",
        date_embauche: "",
        email: "",
        telephone: "",
        sexe: "",
        grade_id: "",
        corps_id: "",
        fonction_id: "",
        photo: null
        
       })
       const soumettre = ()=>{
        form.post(route("employer.store"), {
            onSuccess: (page)=>{
                useSwalSuccess("Employeé ajouté avec success !")
                form.reset()
                inputKey.value += 1
                document.getElementById("image-preview").style.display = "none"
    
            },
            onError: (errors)=>{
                useSwalError("Une erreur a été produite :(")
            }
        })
      }
      const previewtImage = (event)=>{
     if(event.target.files.length>0){
         form.photo = event.target.files[0]
         var src = URL.createObjectURL(event.target.files[0])
         var previewImagee = document.getElementById("image-preview")
         previewImagee.src = src
         previewImagee.style.display = "block"
     }
   }
    </script>
    