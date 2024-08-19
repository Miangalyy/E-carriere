<template>
    <div class="detail" style="margin-top: 100px;">
      <section class="content" style="margin-right: -70px;">
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
    
          </div>
          <div class="col-md-6">
        
            <div class="card card-primary">
            <div class="card-header" style="background: #2a2185;">
            <h3 class="card-title">Ajout d'une evaluation</h3>
            </div>
              <form @submit.prevent="soumettre">
                <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1">Numero_Relation :</label>
                <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.numero" :class="{'is-invalid': form.errors.numero}" required>
                <span v-if="form.errors.numero" class="invalid-feedback error">{{ form.errors.numero }}</span>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Evaluation :</label>
                  <select name="exampleInputPassword1" class="form-control" v-model="form.evaluation_id" required>
                    <option value=""></option>
                    <option :key="Evaluation.id" v-for="Evaluation in props.Evaluations" :value="Evaluation.id">{{ Evaluation.titre }}</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Commentaire de l'evaluation :</label>
                    <textarea class="form-control" id="exampleInputEmail1" v-model="form.commentaire" required>

                    </textarea>
                    </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Numero employer :</label>
                    <select name="exampleInputPassword1" class="form-control" v-model="form.employer_id" required>
                      <option value=""></option>
                      <option :key="Employer.id" v-for="Employer in props.Employers" :value="Employer.id">{{ Employer.numero_employer }}</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Date de l'evaluation :</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                                <input type="date" class="form-control float-right" id="reservation" v-model="form.date" required>
                            </div>
                              <!-- /.input group -->
                        </div>
                </div>
                
                <div class="card-footer">
                  <Link :href="route('evalemple')" class="btn btn-danger mr-2">Retour</Link>
                <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
                </form>
     
            </div>
          </div>
        <div class="col-md-4">
        
      </div>
    </div>
    </div>
    </section>
    </div>
    
    </template>
    
    <script setup>
       import { useForm } from '@inertiajs/inertia-vue3';
       import { useSwalSuccess, useSwalError } from '../../../Composables/alert';
       import { ref } from 'vue';
    
       const props = defineProps({
        Employers: Array,
        Evaluations: Array
       })
       const form = useForm({
        numero: "",
        employer_id: "",
        evaluation_id: "",
        commentaire: "",
        date: ""
        
       })
       const soumettre = ()=>{
        form.post(route("evalemple.store"), {
            onSuccess: (page)=>{
                useSwalSuccess("Evaluation ajouté avec success !")
                form.reset()
    
            },
            onError: (errors)=>{
                useSwalError("Une erreur a été produite :(")
    
            }
        })
      }
    </script>
    