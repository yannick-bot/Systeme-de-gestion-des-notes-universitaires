import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import MyInput from '@/Components/MyInput';
import MyLabel from '@/Components/MyLabel';
import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';
import { ListboxSelectedOption } from '@headlessui/react';


export default function UE() {

    const semestres = [1, 2, 3, 4, 5, 6]

    const { data, setData, post, processing, reset, errors } = useForm({
        code: '',
        nom: '',
        credits_ects: 0,
        semestre: 1
    });



    const handleSubmit = (e : React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        post(route('UE.store'));
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    UE
                </h2>
            }
        >
            <Head title="UE_Form" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <form  onSubmit={handleSubmit}>
                            <MyInput
                                type='text'
                                name='code'
                                id='codeID'
                                labelValue='CODE: '
                                inputValue={data.code}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('code', e.target.value)}
                            />
                            {errors.code && <InputError message={errors.code} className="mt-2" />}
                            <MyInput
                                type='text'
                                name='nom'
                                id='nomID'
                                labelValue='NOM: '
                                inputValue={data.nom}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('nom', e.target.value)}
                            />
                            {errors.nom && <InputError message={errors.nom} className="mt-2" />}
                            <MyInput
                                type='number'
                                name='credits_ects'
                                id='credits_ects_ID'
                                labelValue="CREDIT: "
                                inputValue={data.credits_ects}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('credits_ects', Number(e.target.value))}
                            />
                            {errors.credits_ects && <InputError message={errors.credits_ects} className="mt-2" />}
                            <MyLabel labelFor="semestreID">SEMESTRE: </MyLabel>
                            <select name="semestre" id="semestreID" onChange={e => setData('semestre', Number(e.target.value))}>
                                {semestres.map(semestre => {
                                    return <option key={semestre} value={semestre}>{semestre}</option>
                                })}
                            </select>
                            {errors.semestre && <InputError message={errors.semestre} className="mt-2" />}
                            <div className='my-4'>
                                <button disabled={processing} className='rounded-xl p-2 border-2'>Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
